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
            'user' => $order->account_id,
            'localizador' => $order->locator,
            'monto' => $order->amount,
            'banco' => $order->account->bank->name,
            'fecha' => $order->created_at->format('d-m-Y'),
            'cedula' => $order->account->identification,
            'nombre' => $order->account->name,
            'tasa' => $order->rate,
            'cuenta' => $order->account->number,
            'estatus' => $order->status
        ];
    }
}
