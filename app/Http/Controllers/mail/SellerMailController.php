<?php

namespace App\Http\Controllers;

use App\Mail\SellerMail;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SellerMailController extends Controller
{
    public function sendRequest(Request $request) {
        $request -> validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'business' => 'required',
            'category' => 'required',
            'message' => 'required|string'
        ]);
        try {
            $id = Auth::id();
            $name = $request -> input('name');
            $email = $request -> input('email');
            $phone = $request -> input('phone');
            $business = $request -> input('business');
            $category = $request -> input('category');
            $message = $request -> input('message');

            Mail::to('himmatmagar007@gmail.com') -> send(new SellerMail($id, $name, $email, $phone, $business, $category, $message));
            return redirect() -> back() -> with('status', 'Request send successfully');
        } catch (\Throwable $th) {
            return back()->withErrors(['error' => 'Failed to send email: ' . $th->getMessage()]);
        }
    }
}
