<?php

namespace App\Jobs;

use App\Resources\Woocommerce\Woocommerce;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\ThrottlesExceptionsWithRedis;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class WoocommerceProductCategoriesSync implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public int $tries = 3;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 120;

    private Woocommerce $client;

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
        $start = now();
        $categories = $this->client->category()->list();

        Log::channel('stderr')->info("Category process took: " . now()->diffInSeconds($start) . "s" . "-" . $categories);

        $productCategories = $categories->map(fn($categoryEntity) => $categoryEntity->toModel());

        Auth::user()->productCategories()->insert($productCategories);
    }

    /**
     * Get the middleware the job should pass through.
     *
     * @return array
     */
    public function middleware(): array
    {
        return [new ThrottlesExceptionsWithRedis(6, 2)];
    }

    /**
     * Determine the time at which the job should timeout.
     *
     * @return Carbon
     */
    public function retryUntil(): Carbon
    {
        return now()->addMinutes(1);
    }
}