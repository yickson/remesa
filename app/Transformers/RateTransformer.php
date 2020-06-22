<?php

namespace App\Transformers;

use App\Rate;
use League\Fractal\TransformerAbstract;

class RateTransformer extends TransformerAbstract
{
    public function transform(Rate $rate)
    {
        return [
            'id' => $rate->id,
            'valor' => $rate->value,
            'fecha' => $rate->created_at->format('d-m-Y')
        ];
    }
}