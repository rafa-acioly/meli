<?php

namespace App\Jobs;

use App\Models\User;
use App\Resources\Woocommerce\Woocommerce;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\ThrottlesExceptionsWithRedis;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class WoocommerceProductCategoriesSync implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The name of the queue the job should be sent to.
     *
     * @var string|null
     */
    public $queue = 'product_category_sync';

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
    public $timeout = 30;

    private Woocommerce $client;

    private User $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Woocommerce $client, User $user)
    {
        $this->client = $client;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $wooCategories = $this->client->category()->list();

        $categoryModels = $wooCategories->map(fn($wooCategory) => $wooCategory->toModel());

        $this->removeUnnecessaryCategories($categoryModels->pluck('id_on_store'));

        $categoryModels->each(fn($category) => $this->user->productCategories()->updateOrCreate([
            'id_on_store' => $category->id_on_store
        ], $category->toArray()));
    }


    private function removeUnnecessaryCategories(Collection $categoryIDS)
    {
        $this->user->productCategories()
            ->whereNotIn('id_on_store', $categoryIDS)
            ->delete();
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
        return now()->addMinutes();
    }
}
