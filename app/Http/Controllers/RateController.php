<?php

namespace App\Http\Controllers;

use App\Rate;
use Illuminate\Http\Request;

class RateController extends Controller
{
    public function show()
    {
        $rate = Rate::orderBy('created_at', 'DESC')->first();
        return response()->json($rate);
    }
}
