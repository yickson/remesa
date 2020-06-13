<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Fractalistic\Fractal;
use App\Transformers\OrderTransformer;

class OrderController extends Controller
{
    public function index()
    {
        return view('admin.orders.index');
    }

    public function list_orders()
    {
        $orders = Order::with('account', 'user')->get();
        $orders = Fractal::create()->collection($orders)->transformWith(new OrderTransformer())->toArray();
        return response()->json($orders);
    }
}
