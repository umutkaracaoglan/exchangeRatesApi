<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\ExchangeRates
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property float|null $rate_buy
 * @property float|null $rate_sell
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ExchangeRates newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExchangeRates newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExchangeRates query()
 * @method static \Illuminate\Database\Eloquent\Builder|ExchangeRates whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExchangeRates whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExchangeRates whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExchangeRates whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExchangeRates whereRateBuy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExchangeRates whereRateSell($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExchangeRates whereUpdatedAt($value)
 */
	class ExchangeRates extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserActivityLogs
 *
 * @property int $id
 * @property int $user_id
 * @property string $endpoint
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserActivityLogs newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserActivityLogs newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserActivityLogs query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserActivityLogs whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserActivityLogs whereEndpoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserActivityLogs whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserActivityLogs whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserActivityLogs whereUserId($value)
 */
	class UserActivityLogs extends \Eloquent {}
}

