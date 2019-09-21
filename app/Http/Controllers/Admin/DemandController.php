<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

    }
}
