<?php

namespace App\Jobs;

use App\Resources\Woocommerce\Woocommerce;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class WoocommerceWebhookCreation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Woocommerce $client;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public int $tries = 3;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Woocommerce $client)
    {

        $this->client = $client;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->client->webhook()->batch();
    }
}
