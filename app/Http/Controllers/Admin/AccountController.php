<?php

namespace App\Http\Controllers\Admin;

use App\Bank;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{
    public function index()
    {
        return view('admin.account.index');
    }

    public function list_accounts()
    {

    }

    public function create()
    {
        $banks = Bank::all();
        return view('admin.account.create', compact('banks'));
    }
}
