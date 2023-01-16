<?php

namespace App\Console\Commands;

use App\Models\ExchangeRates;
use App\Services\GetExchange\IsbankExchangeRateService;
use Carbon\Traits\Date;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class GetExchangeRates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exchangerates:get';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get exchange rates';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(IsbankExchangeRateService $exchangeRateService)
    {
        $exchangeRates = $exchangeRateService->getExchangeRates();
        $exchangeRateService->saveExchangeRates($exchangeRates);
        Log::info('GetExchangeRates command ran on ' . Carbon::now());
        return Command::SUCCESS;
    }



}
