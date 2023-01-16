<?php

namespace App\Services\GetExchange;


use App\Models\ExchangeRates;

class IsbankExchangeRateService extends ExchangeRateServiceAbstract
{

    protected function getApiUrl(): string
    {
        return 'https://www.isbank.com.tr/_vti_bin/DV.Isbank/PriceAndRate/PriceAndRateService.svc/GetFxRates?Lang=tr&fxRateType=IB&date=' . \date('Y-m-d');
    }

    public function parseName($data): string
    {
        return $data['description'];
    }

    public function parseCode($data): string
    {
        return $data['code'];
    }

    public function parseRateBuy($data): float
    {
        return $data['effectiveRateBuy'];
    }

    public function parseRateSell($data): float
    {
        return $data['effectiveRateSell'];
    }

    public function getExchangeRates(): array
    {
        $data = $this->fetchData();
        $exchangeRates = [];
        foreach ($data['Data'] as $rate) {
            if (!in_array($rate['code'], $this->getSelectedRates())) {
                continue;
            }
            $exchangeRates[] = [
                'name' => $this->parseName($rate),
                'code' => $this->parseCode($rate),
                'rate_buy' => $this->parseRateBuy($rate),
                'rate_sell' => $this->parseRateSell($rate),
            ];
        }
        return $exchangeRates;
    }

    public function saveExchangeRates($exchangeRates)
    {
        foreach ($exchangeRates as $rate) {
            /** @var ExchangeRates $exchangeRates */
            $exchangeRates = new ExchangeRates();
            $exchangeRates->name = $rate['name'];
            $exchangeRates->code = $rate['code'];
            $exchangeRates->rate_buy = $rate['rate_buy'];
            $exchangeRates->rate_sell = $rate['rate_sell'];
            $exchangeRates->save();
        }
    }

}
