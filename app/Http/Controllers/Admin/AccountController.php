<?php

namespace App\Http\Controllers\Admin;

use App\Bank;
use App\Account;
use App\Transformers\AccountTransformer;
use Spatie\Fractalistic\Fractal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
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
        $accounts = Fractal::create()->collection($accounts)->transformWith(new AccountTransformer())->toArray();
        return response()->json($accounts);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
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
        $account = Account::create([
            'bank_id' => $request->bank,
            'name' => $request->nameAccount,
            'identification' => $request->dniAccount,
            'number' => $request->numberAccount,
            'user_id' => $userId
        ]);

        $accountCreated = Account::find($account->id);

        $data = [
            'response' => true,
            'message' => 'Cuenta creada correctamente',
            'data' => $accountCreated
        ];
        return response()->json($data);
    }

    public function delete_account(int $id)
    {
        $account = Account::find($id);
        if($account){
            Account::destroy($account->id);
            $data = [
                'response' => true,
                'message' => 'Cuenta eliminada correctamente',
                'data' => ''
            ];
            return response()->json($data);
        } else {
            $data = [
                'response' => false,
                'message' => 'Esta cuenta no existe',
                'data' => ''
            ];
            return response()->json($data);
        }
    }

    public function create()
    {
        $banks = Bank::all();
        return view('admin.account.create', compact('banks'));
    }
}
