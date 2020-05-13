<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Rate
 *
 * @property int $id
 * @property float $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rate query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rate whereValue($value)
 * @mixin \Eloquent
 */
class Rate extends Model
{
    protected $fillable = [
        'value'
    ];
}
