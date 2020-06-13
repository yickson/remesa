<?php

namespace App\Transformers;

use App\Order;
use League\Fractal\TransformerAbstract;

class OrderTransformer extends TransformerAbstract
{
    public function transform(Order $order)
    {
        return [
            'id' => $order->id,
            'locator' => $order->locator,
            'amount' => $order->amount,
            'bank' => $order->account->bank->name,
            'date' => $order->created_at->format('d-m-Y'),
            'identification' => $order->account->identification,
            'name' => $order->account->name,
            'number' => $order->account->number,
            'status' => $order->status
        ];
    }
}
