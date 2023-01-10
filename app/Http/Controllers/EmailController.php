<?php

namespace App\Http\Controllers;

use App\Mail\sendingMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function index(Request $request)
    {
        $message = $request->session()->get('message');
        return view('contact', ['message' => $message]);
    }

    public function send(Request $request)
    {
        // apply validations
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        $data = array(
            'name' => $request->name,
            'message' => $request->message,
        );

        // send mail
        Mail::to('adonaibm@gmail.com')->send(new sendingMail($data));
        // save message on session (via flash)
        $request->session()->flash('message', 'Thanks for contact us!');
        // redirect the user
        return redirect('/contact');
    }
}
