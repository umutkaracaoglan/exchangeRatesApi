<?php

namespace App\Services\GetExchange;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\TransferException;
use Illuminate\Support\Facades\Log;

abstract class ExchangeRateServiceAbstract
{

    abstract public function getExchangeRates(): array;
    abstract public function saveExchangeRates($exchangeRates);

    protected function getSelectedRates(): array
    {
        return config('exchangerates.selected_rates');
    }

    protected function fetchData(): array
    {
        $client = new \GuzzleHttp\Client();
        try {
            $res = $client->request(
                'GET',
                $this->getApiUrl(),
                []
            );
            return json_decode($res->getBody(), true);
        } catch (TransferException $e) {
            Log::warning('Error fetching exchange rates: ' . $e->getMessage());
            return [];
        } catch (GuzzleException $e) {
            Log::warning('Error fetching exchange rates: ' . $e->getMessage());
            return [];
        }
    }

    abstract protected function getApiUrl(): string;
    public abstract function parseName($data): string;
    public abstract function parseCode($data): string;
    public abstract function parseRateBuy($data): float;
    public abstract function parseRateSell($data): float;

}
