<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        //See all user of platform
        return view('admin.users.index');
    }

    public function list_users()
    {
        $usuarios = User::all();
        return response()->json($usuarios);
    }
}
