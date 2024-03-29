<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExchangeRates extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'code', 'rate_buy', 'rate_sell'
    ];

    protected $hidden = [
        'id', 'created_at'
    ];


}
