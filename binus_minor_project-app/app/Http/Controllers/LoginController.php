<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CartItem;
use App\Models\Product;

class LoginController extends Controller
{
    // display login form
    public function showLoginForm() { return view('login'); }

    // handle login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            // get saved cart items of the user from database
            $savedCartItems = CartItem::where('user_id', $user->id)->get();
            
            if ($savedCartItems->isNotEmpty()) {
                $cart = [];
                foreach ($savedCartItems as $item) {
                    $product = Product::find($item->product_id);
                    if ($product) {
                        $cart[$product->id] = [
                            'id' => $product->id,
                            'name' => $product->name,
                            'price' => $product->price,
                            'image' => $product->image_url,
                            'quantity' => $item->quantity,
                        ];
                    }
                }
                // merge saved cart items with current session cart
                session()->put('cart', $cart);
                
                // delete old version of cart items of the user
                CartItem::where('user_id', $user->id)->delete();
            }
            return redirect('/')->with('success', 'Welcome back!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // logout user
    public function logout(Request $request)
    {
        $user = Auth::user();
        $cart = session()->get('cart', []);

        if ($user && !empty($cart)) {
            // delete old version of cart items for this user
            CartItem::where('user_id', $user->id)->delete();

            //  save current cart items to database
            foreach ($cart as $item) {
                CartItem::create([
                    'user_id' => $user->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                ]);
            }
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}