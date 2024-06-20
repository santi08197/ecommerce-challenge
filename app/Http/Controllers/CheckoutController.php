<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function payment()
    {
        return view('checkout.payment');
    }

    public function processPayment(Request $request)
    {
        $paymentMethod = $request->validate([
            'payment_method' => 'required', 
        ]);

        $request->session()->put('paymentMethod', $paymentMethod);

        return redirect()->route('checkout.review');

    }

    public function review(Request $request)
    {
        $cartItems = $request->cookie('cart_items') ? json_decode($request->cookie('cart_items'), true) : [];
        
        $paymentMethod = $request->session()->get('paymentMethod')['payment_method'];

        return view('checkout.review', [
            'paymentMethod' => $paymentMethod,
            'cartItems' => $cartItems,
        ]);
    }
}
