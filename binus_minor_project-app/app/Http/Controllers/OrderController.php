<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function checkout()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('checkout', compact('cart', 'total'));
    }

    public function placeOrder(Request $request)
    {
        $cart = session()->get('cart', []);
    
        if (empty($cart)) {
            return redirect()->route('home')->with('error', 'Your cart is empty!');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:1000',
            'payment_method' => 'required|in:mybca,debit,credit',
        ]);

        session()->forget('cart');

        return redirect()->route('order.success');
    }

    public function success()
    {
        return view('order-success');
    }
}