<?php

namespace App\Providers;

use App\Services\Sale\SaleService;
use App\Services\Sale\SaleServiceInterface;
use App\Services\Seller\SellerService;
use App\Services\Seller\SellerServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $singletons = [
        SellerServiceInterface::class => SellerService::class,
        SaleServiceInterface::class => SaleService::class,
    ];
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
