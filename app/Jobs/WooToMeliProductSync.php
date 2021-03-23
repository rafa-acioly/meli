<?php

namespace App\Jobs;

use App\Http\Requests\WoocommerceProductRequest;
use Dsc\MercadoLivre\Announcement;
use Dsc\MercadoLivre\Meli;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\ThrottlesExceptionsWithRedis;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class WooToMeliProductSync implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The name of the queue the job should be sent to.
     *
     * @var string|null
     */
    public $queue = 'woo_to_meli_product';

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public int $tries = 3;

    private Meli $client;

    private WoocommerceProductRequest $request;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Meli $client, WoocommerceProductRequest $request)
    {
        $this->client = $client;
        $this->request = $request;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $announcement = new Announcement($this->client);

        $announcement->update('', [
            'title' => $this->request->input('name'),
            'price' => $this->request->input('price'),
            'available_quantity' => $this->request->input('stock_quantity'),

            /**
             * TODO: Verificar qual o campo do woocommerce define se o produto esta ativo
             */
            'status' => $this->request->input('')
        ]);
    }

    /**
     * Get the middleware the job should pass through.
     *
     * @return array
     */
    public function middleware(): array
    {
        return [new ThrottlesExceptionsWithRedis(5, 2)];
    }

    /**
     * Determine the time at which the job should timeout.
     *
     * @return \DateTime
     */
    public function retryUntil()
    {
        return now()->addMinutes(3);
    }
}
