<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserActivityLogs extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'endpoint'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
