<?php

namespace App\Http\Controllers\Admin;

use App\Bank;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BankController extends Controller
{
    public function index()
    {
        return view('admin.banks.index');
    }

    public function list_banks()
    {
        $bancos = Bank::all();
        return response()->json($bancos);
    }

    public function view(Request $request)
    {
        $bank = Bank::find($request->id);
        return response()->json($bank);
    }
}
