<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contact()
    {
        return view('public.contact');
    }

    public function send_contact(Request $request)
    {
        
    }
}
