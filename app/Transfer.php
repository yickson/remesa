<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Transfer
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Transfer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Transfer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Transfer query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Transfer whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Transfer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Transfer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Transfer whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Transfer whereReference($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Transfer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Transfer whereUserId($value)
 * @mixin \Eloquent
 */
class Transfer extends Model
{
    protected $fillable = [
        'amount',
        'reference',
        'user_id',
        'order_id'
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
