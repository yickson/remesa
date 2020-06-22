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
        $rates = Rate::all();
        $rates = Fractal::create()->collection($rates)->transformWith(new RateTransformer())->toArray();
        return response()->json($rates);
    }
}
