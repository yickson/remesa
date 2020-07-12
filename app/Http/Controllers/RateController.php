<?php

namespace App\Http\Controllers;

use App\Rate;
use Illuminate\Http\Request;

class RateController extends Controller
{
    public function show()
    {
        $rate = Rate::latest()->first();
        return response()->json($rate);
    }
}
