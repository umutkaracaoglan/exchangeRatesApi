<?php

namespace App\Http\Controllers\Api\V1;

use App\Console\Commands\GetExchangeRates;
use App\Http\Controllers\Controller;
use App\Models\ExchangeRates;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;

class ExchangeRateController extends ApiController
{

    /**
     * Get exchangerates
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $date         = Carbon::now()->subMinutes(15);
        $echangeRates = ExchangeRates::where('updated_at', '>=', $date);

        // If it does empty or it works for the first time.
        if ($echangeRates->get()->isEmpty()) {
            Artisan::call('exchangerates:get');
        }

        return $this->success($this->filter($request, $echangeRates)->toArray());
    }

    /**
     * Filtering
     * @param Request $request
     * @param         $exchangeRates
     * @return mixed
     */
    public function filter(Request $request, $exchangeRates)
    {
        if ($request->has('code')) {
            $exchangeRates->where('code', $request->input('code'));
        }

        //Pagination
        $perPage = $request->input('per_page', 25);
        return $exchangeRates->paginate($perPage);
    }

    /**
     * Convert exchangerates
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function convert(Request $request)
    {
        $selectedRates = implode(',', config('exchangerates.selected_rates'));
        $validatedData = $request->validate([
            'from'   => 'required|string|in:' . $selectedRates,
            'to'     => 'required|string|in:' . $selectedRates,
            'amount' => 'required|numeric|min:0',
        ],
            ['from.required'   => 'From parameter is required',
             'from.string'     => 'From parameter must be a string',
             'from.in'         => "Invalid 'from' currency. Supported currencies: [{$selectedRates}]",
             'to.required'     => 'To parameter is required',
             'to.string'       => 'To parameter must be a string',
             'to.in'           => "Invalid 'to' parameter. Supported currencies: [{$selectedRates}]",
             'amount.required' => 'Amount is required',
             'amount.numeric'  => 'Amount must be numeric',
             'amount.min'      => 'Amount must be greater than or equal to 0'
            ]
        );

        $from         = $request->input('from');
        $to           = $request->input('to');
        $date         = Carbon::now()->subMinutes(15);
        $exhangeRates = ExchangeRates::where('updated_at', '>=', $date);

        // If it does empty or it works for the first time.
        if ($exhangeRates->get()->isEmpty()) {
            Artisan::call('exchangerates:get');
        }

        $fromRate = ExchangeRates::where('updated_at', '>=', $date)->where('code', $from)->first();
        $toRate   = ExchangeRates::where('updated_at', '>=', $date)->where('code', $to)->first();
        $convertedAmount = $fromRate->rate_buy * $request->input('amount') / $toRate->rate_buy;


        return $this->success([
            "converted_amount" => number_format($convertedAmount,4),
            "from"             => $from,
            "to"               => $to,
        ]);
    }
}
