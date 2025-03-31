<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ContactRequestController extends Controller
{
    public function sendRequest(Request $request) {
        $request -> validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string'
        ]);
        try {
            $id = Auth::id();
            $name = $request -> input('name');
            $email = $request -> input('email');
            $message = $request -> input('message');

            Mail::to('himmatmagar007@gmail.com') -> send(new ContactMail($id, $name, $email, $message));
            return redirect() -> back() -> with('status', 'Contact request successfully');
        } catch (\Throwable $th) {
            return back()->withErrors(['error' => 'Failed to send email: ' . $th->getMessage()]);
        }
    }
}
