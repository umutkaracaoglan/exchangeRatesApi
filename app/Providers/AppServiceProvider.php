<?php

namespace App\Providers;

use App\Services\GetExchange\ExchangeRateServiceAbstract;
use App\Services\GetExchange\IsbankExchangeRateService;
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
        $serviceName = config('exchangerates.exchange_rate_service_provider');

        switch ($serviceName) {
            case 'isbank':
                $this->app->bind(ExchangeRateServiceAbstract::class, IsbankExchangeRateService::class);
                break;
            default:
                throw new \Exception("Invalid exchange rate service specified: " . $serviceName);
                break;
        }

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
