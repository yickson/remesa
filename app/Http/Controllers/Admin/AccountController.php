<?php

namespace App\Http\Controllers\Admin;

use App\Bank;
use App\Account;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;

class AccountController extends Controller
{
    public function index()
    {
        $banks = Bank::all();
        return view('admin.account.index', ['banks' => $banks]);
    }

    public function list_accounts()
    {
        $userId = Auth::id();
        $accounts = Account::where('user_id', $userId)->get();

        return response()->json($accounts);
    }

    public function create_account(Request $request)
    {
        $userId = Auth::id();
        $validate = Validator::make($request->all(), [
            'bank' => 'required|numeric',
            'nameAccount' => 'required',
            'numberAccount' => 'required|numeric',
            'dniAccount' => 'required|numeric',
        ]);

        if($validate->fails()) {
            return response()->json($validate->errors(), 422);
        }

        Account::create([
            'bank_id' => $request->bank,
            'name' => $request->nameAccount,
            'identification' => $request->dniAccount,
            'number' => $request->numberAccount,
            'user_id' => $userId
        ]);
        $data = [
            'response' => true,
            'message' => 'Cuenta creada correctamente'
        ];
        return response()->json($data);
    }

    public function create()
    {
        $banks = Bank::all();
        return view('admin.account.create', compact('banks'));
    }
}
