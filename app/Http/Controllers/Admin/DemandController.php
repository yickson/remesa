<?php

namespace App\Http\Controllers\Admin;

use App\Functions\Utilities;
use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;

class DemandController extends Controller
{
    public function index()
    {
        return view('admin.demands.index');
    }

    public function list_demands()
    {
        $orders = Order::with(['account' => function($q){ $q->with('bank'); }])->where('user_id', auth()->id())->get();
        $data = [];
        foreach ($orders as $i => $order) {
            $data[$i]['locator'] = $order->locator;
            $data[$i]['amount'] = $order->amount;
            $data[$i]['bank'] = $order->account->bank->name;
            $data[$i]['account_name'] = $order->account->name;
            $data[$i]['account_dni'] = $order->account->identification;
            $data[$i]['account_number'] = $order->account->number;
            $data[$i]['status'] = $order->status;
            $data[$i]['date'] = $order->created_at->format('d-m-Y');
        }
        return response()->json($data);
    }

    public function create()
    {
        return view('admin.demands.create');
    }

    public function create_demand(Request $request)
    {
        $userId = Auth::id();
        $validate = Validator::make($request->all(), [
            'account' => 'required|numeric',
            'amount' => 'required|numeric'
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 422);
        }

        $order = Order::create([
            'locator' => Utilities::generateLocator(),
            'amount' => $request->amount,
            'status' => Order::PROCESSING,
            'account_id' => $request->account,
            'user_id' => $userId
        ]);

        $orderCreated = Order::find($order->id);

        $data = [
            'response' => true,
            'message' => 'Solicitud creada correctamente',
            'data' => $orderCreated
        ];
        return response()->json($data);
    }
}
