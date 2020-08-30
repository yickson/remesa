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
        $orders = Order::with(['account.bank', 'user'])->where('status', '<>', Order::CANCELLED)->orderBy('id', 'desc')->get();
        $orders = Fractal::create()->collection($orders)->transformWith(new OrderTransformer())->toArray();
        return response()->json($orders);
    }

    public function validate_order(int $id)
    {
        $order = Order::find($id);
        if($order) {
            $order->status = Order::VALIDATED;
            $order->save();
            return response()->json(['message' => 'Orden validada']);
        } else {
            return response()->json(['error' => 'No existe esta orden']);
        }
    }

    public function delete_order(int $id)
    {
        $order = Order::find($id);
        if($order) {
            $order->status = Order::CANCELLED;
            $order->save();
            return response()->json(['message' => 'Orden eliminada']);
        } else {
            return response()->json(['error' => 'No existe esta orden']);
        }
    }
}
