<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class UserController extends Controller
{
    /**     * Cart Data Store     */

    private function cart_login(Request $request)
    {
        $cartData = $request->cookie('cart');

        if ($cartData) {
            $cartItems = json_decode($cartData, true);
            $productIds = array_column($cartItems, 'product_id');
            foreach ($productIds as $productId) {

                $cart = new Cart();
                $cart->user_id = Auth::user()->id; // Assuming you have a user_id column in your carts table
                $cart->email = Auth::user()->email;
                $cart->product_id  = $productId;
                $cart->product_quantity = 1;
                $cart->save();
            }
        }
        /* Remove All window Cookie data  */
        Cookie::queue(Cookie::forget('cart'));
    }
/**     * Register Or Create User     */

    public function create()
    {
        return view('admin.auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'role' => 'required',
            'password' => 'required',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = $request->password;
        $user->mobile = rand(1000, 9999);
        $user->save();
        return redirect('/login')->with('success', 'Item created successfully!');
    }

    /**     * Login     */
    public function login_show()
    {
        return view('admin.auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        $remember_me = $request->has('remember_me') ? true : false;
        $check = $request->only('email', 'password');
        if (Auth::attempt($credentials, $check, $remember_me)) {
            $data = $request->session()->regenerate();
            $cart =  $this->cart_login($request);
            if (Auth()->user()->role == 'customer') {
                return redirect()->intended('clist')->with('success', 'You have logged In successfully!');
            } else {

                return redirect()->intended('/admin')->with('success', 'You have logged In successfully!');
            }
        } else {
            return back()->with('error', 'Invalid Email address or Password');
        }
    }

    /**     * Logout function     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
            ->withSuccess('You have logged out successfully!');
    }

}
