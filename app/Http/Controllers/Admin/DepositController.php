<?php

namespace App\Http\Controllers\Admin;

use App\Deposit;
use App\Http\Controllers\Controller;
use App\Mail\OrderTransferMail;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use Validator;
use Mail;

class DepositController extends Controller
{
    public function index()
    {
        //Vista para ver todos los depositos realizados
    }

    public function create_deposit(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'reference' => 'required',
            'amount' => 'required',
            'user' => 'required',
            'order' => 'required'
        ]);

        if($validate->fails()) {
            return response()->json($validate->errors(), 422);
        }

        $deposit = Deposit::create([
            'amount' => $request->amount,
            'reference' => $request->reference,
            'user_id' => $request->user,
            'order_id' => $request->order
        ]);

        if($deposit) {
            $order = Order::find($request->order);
            if ($order) {
                $order->status = Order::FINISHED;
                $order->save();
                $user = User::find($order->user_id);
                Mail::to($user->email)->later(60, new OrderTransferMail($deposit, $user));
                return response()->json(['message' => 'Depósito creado exitosamente']);
            } else {
                return response()->json(['error' => 'Error no existe la orden']);
            }
        } else {
            return response()->json(['error' => 'Error al crear el depósito']);
        }
    }
}
