<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\ExchangeRates;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ExchangeRateController extends ApiController
{

    public function index(Request $request)
    {
        $date = Carbon::now()->subMinutes(15);
        $echangeRates = ExchangeRates::where('updated_at', '>=', $date);

        return $this->success( $this->filter($request, $echangeRates)->toArray());
    }

    /**
     * Filtering code
     */
    public function filter(Request $request, $exchangeRates)
    {
        if ($request->has('code')) {
            $exchangeRates->where('code', $request->input('code'));
        }

        return $exchangeRates->get();
    }

}
