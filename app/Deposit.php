<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Deposit
 *
 * @property int $id
 * @property int $amount
 * @property string $reference
 * @property int $user_id
 * @property int $order_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Order $order
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Deposit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Deposit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Deposit query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Deposit whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Deposit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Deposit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Deposit whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Deposit whereReference($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Deposit whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Deposit whereUserId($value)
 * @mixin \Eloquent
 */
class Deposit extends Model
{
    protected $fillable = [
        'amount',
        'reference',
        'user_id',
        'order_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function order()
    {
        return $this->belongsTo('App\Order');
    }
}
