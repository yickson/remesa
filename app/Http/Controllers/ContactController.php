<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Validator;

class ContactController extends Controller
{
    public function contact()
    {
        return view('public.contact');
    }

    public function send_contact(Request $request)
    {
        $validate = Validator::make($request->all(), [
           'name' => 'required',
           'last_name' => 'required',
           'email' => 'required|email',
           'phone' => 'required',
           'message' => 'required'
        ]);

        if($validate->fails()) {
            return response()->json($validate->errors(), 422);
        }
        Mail::to($request->email)->later(180, new ContactMail($request->all()));

        return response()->json('Contacto enviado', 200);
    }
}
