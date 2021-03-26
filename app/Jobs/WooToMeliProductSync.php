<?php

namespace App\Jobs;

use App\Models\User;
use App\Resources\Woocommerce\Entity\Product as ProductEntity;
use Dsc\MercadoLivre\Announcement;
use Dsc\MercadoLivre\Meli;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\ThrottlesExceptionsWithRedis;
use Illuminate\Queue\SerializesModels;

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

    private ProductEntity $product;

    private User $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Meli $client, ProductEntity $product, User $user)
    {
        $this->client = $client;
        $this->product = $product;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        /**
         * 1. Get the product from Woocommerce API
         * 2. Update the product on Mercado livre API
         * 3. Update the product on our database
         */
    }

    /**
     * Get the middleware the job should pass through.
     *
     * @return array
     */
    public function middleware(): array
    {
        return [new ThrottlesExceptionsWithRedis(3, 1)];
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
