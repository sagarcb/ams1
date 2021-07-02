<?php

namespace App\Http\Controllers;

use App\Mail\MyTestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendEmailController extends Controller
{
    public function index()
    {
        return view('mail.mail');
    }

    function send(Request $request)
    {
        $this->validate($request, [
            'name'     =>  'required',
            'email'  =>  'required|email',
            'message' =>  'required'
        ]);

        $data['name'] = $request->name;
        $data['message'] = $request->message;

        Mail::to('sagar.cb.009@gmail.com')->send(new MyTestMail($data));
        return back()->with('success', 'Thanks for contacting us!');
    }
}
