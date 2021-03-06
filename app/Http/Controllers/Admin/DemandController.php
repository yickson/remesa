<?php

namespace App\Http\Controllers\Admin;

use App\Functions\Utilities;
use App\Mail\OrderCreatedMail;
use App\Order;
use App\Rate;
use App\Transformers\OrderTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Fractalistic\Fractal;
use Illuminate\Support\Facades\Mail;
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
        $orders = Fractal::create()->collection($orders)->transformWith(new OrderTransformer())->toArray();
        return response()->json($orders);
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

        $rate = Rate::latest()->first();
        $order = Order::create([
            'locator' => Utilities::generateLocator(),
            'amount' => $request->amount,
            'status' => Order::STARTING,
            'account_id' => $request->account,
            'user_id' => $userId,
            'rate' => $rate->value
        ]);

        $orderCreated = Order::find($order->id);
        Mail::to(env('EMAIL_MAIN'))->later(60, new OrderCreatedMail($orderCreated));
        $data = [
            'response' => true,
            'message' => 'Solicitud creada correctamente',
            'data' => $orderCreated
        ];
        return response()->json($data);
    }
}
