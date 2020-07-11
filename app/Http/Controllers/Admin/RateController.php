<?php

namespace App\Http\Controllers\Admin;

use App\Rate;
use App\Transformers\RateTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Fractalistic\Fractal;

class RateController extends Controller
{
    public function index()
    {
        return view('admin.rates.index');
    }

    public function list_rates()
    {
        $rates = Rate::all()->sortByDesc('created_at');
        $rates = Fractal::create()->collection($rates)->transformWith(new RateTransformer())->toArray();
        return response()->json($rates);
    }

    public function create_rate(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'rate' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        Rate::create([
            'value' => $request->rate
        ]);

        $data = [
            'response' => true,
            'message' => 'Tasa creada correctamente',
            'data' => ''
        ];

        return response()->json($data);
    }

    public function update_rate()
    {

    }
}
