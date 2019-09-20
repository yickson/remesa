<?php

namespace App\Http\Controllers\Admin;

use App\Rate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RateController extends Controller
{
    public function index()
    {
        return view('admin.rates.index');
    }

    public function list_rates()
    {
        $rates = Rate::all();
        return response()->json($rates);
    }
}
