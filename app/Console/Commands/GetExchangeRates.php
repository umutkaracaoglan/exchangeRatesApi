<?php

namespace App\Console\Commands;

use App\Models\ExchangeRates;
use Carbon\Traits\Date;
use GuzzleHttp\Exception\TransferException;
use http\Client;
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
    public function handle()
    {

        // Only 5 currencies
        $selectedRates = ['USD', 'EUR', 'GBP', 'JPY', 'CHF' ];
        $client = new \GuzzleHttp\Client();

        try {
            $res   = $client->request(
                'GET',
                'https://www.isbank.com.tr/_vti_bin/DV.Isbank/PriceAndRate/PriceAndRateService.svc/GetFxRates?Lang=tr&fxRateType=IB&date=' . \date('Y-m-d'),
                []);
            $rates = json_decode($res->getBody(), true);
        } catch (TransferException $e) {
            Log::warning('GetExchangeRates command not ran on ' . Carbon::now());
            return Command::FAILURE;
        }

        foreach ($rates['Data'] as $key => $rate) {

            if(!in_array($rate['code'], $selectedRates)){
                continue;
            }

            /** @var ExchangeRates $exchangeRates */
            $exchangeRates            = new ExchangeRates();
            $exchangeRates->name      = $rate['description'];
            $exchangeRates->code      = $rate['code'];
            $exchangeRates->rate_buy  = $rate['effectiveRateBuy'];
            $exchangeRates->rate_sell = $rate['effectiveRateSell'];
            $exchangeRates->save();
        }

        Log::info('GetExchangeRates command ran on ' . Carbon::now());
        return Command::SUCCESS;
    }



}
