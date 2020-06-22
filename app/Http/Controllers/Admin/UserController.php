<?php

namespace App\Http\Controllers\Admin;

use App\Transformers\UserTransformer;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Fractalistic\Fractal;

class UserController extends Controller
{
    public function index()
    {
        //See all user of platform
        return view('admin.users.index');
    }

    public function list_users()
    {
        $users = User::all();
        $users = Fractal::create()->collection($users)->transformWith(new UserTransformer())->toArray();
        return response()->json($users);
    }
}
