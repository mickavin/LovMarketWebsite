<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;
use Carbon\Carbon;
use App\Policies\ProductPolicy;
use App\Product;
use App\Policies\CategoryPolicy;
use App\Product_category;
use App\Policies\ShopPolicy;
use App\Shop;
use App\Policies\OrderPolicy;
use App\Order;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        Product::class => ProductPolicy::class,
        Product_category::class => CategoryPolicy::class,
        Shop::class => ShopPolicy::class,
        Order::class => OrderPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Passport::routes();
        Passport::tokensExpireIn(Carbon::now()->addDays(1));
        Passport::refreshTokensExpireIn(Carbon::now()->addDays(10));
        Passport::enableImplicitGrant();
    }
}
