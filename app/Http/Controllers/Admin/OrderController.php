<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {
        return view('admin.orders.index');
    }

    public function list_orders()
    {
        $orders = Order::with('account', 'user')->get();
        $data = [];
        foreach ($orders as $i => $order)
        {
            $data[$i]['locator'] = $order->locator;
            $data[$i]['amount'] = $order->amount;
            $data[$i]['status'] = $order->status;
            $data[$i]['account_name'] = $order->account->name;
            $data[$i]['account_dni'] = $order->account->identification;
            $data[$i]['account_number'] = $order->account->number;
            $data[$i]['user'] = $order->user->name;
        }
        return response()->json($data);
    }
}
