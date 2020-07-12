<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use App\Transfer;
use Illuminate\Http\Request;
use Validator;

class TransferController extends Controller
{
    public function index()
    {
        //Vista para ver todas las transferencias
    }

    public function create_transfer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required',
            'reference' => 'required',
            'user' => 'required',
            'order' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Falta información'], 422);
        }

        $transfer = Transfer::create([
            'amount' => $request->amount,
            'reference' => $request->reference,
            'user_id' => $request->user,
            'order_id' => $request->order
        ]);

        if ($transfer) {
            $order = Order::find($request->order);
            if ($order) {
                $order->status = Order::PROCESSING;
                $order->save();
                return response()->json(['message' => 'Orden actualizada']);
            } else {
                return response()->json(['error' => 'No existe la orden']);
            }
        } else {
            return response()->json(['error' => 'No se ejecuto la transferencia']);
        }
    }
}
