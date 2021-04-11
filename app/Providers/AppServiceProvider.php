<?php

namespace App\Providers;

use App\Services\PaymentInterface;
use App\Services\StripePaymentService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      $this->app->singleton(PaymentInterface::class, StripePaymentService::class);
    }
}
