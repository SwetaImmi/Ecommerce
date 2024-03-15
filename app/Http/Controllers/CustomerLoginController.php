<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class CustomerLoginController extends Controller
{
    public function signUp_show()
    {
        return view('home.signUp');
    }

    public function signUp_store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password'  =>  'required|between:2,255|same:confirmPassword',
            'confirmPassword'  =>  'required',
        ]);
        $emailPhone = $request->email;
        $phone = preg_match('/^\d{10}$/', $emailPhone);
        $email = filter_var($emailPhone, FILTER_VALIDATE_EMAIL);

        // return $email;
        $user = new User();
        $user->name = $request->name;
        if (is_numeric($emailPhone)) {
            if ($phone) {
                $user->mobile = $emailPhone;
                $user->email = bcrypt(rand(100, 999));
            }
            $error = "invalid phone address.";
        } else {
            if ($email) {
                $user->email = $emailPhone;
                $user->mobile = bcrypt(rand(100, 999));
            }
            $error = "invalid email address.";
        }

        $user->role = 'customer';
        $user->password = $request->password;
        // dd($user);
        $user->save();
        return redirect('/')->with('success', 'Item created successfully!');
    }

    // public function customer_login_viwe()
    // {
    //     return view('home.cust_login');
    // }

    // public function customer_login(Request $request)
    // {

    //     $credentials = $request->validate([
    //         'email' => ['required'],
    //         //    'phone' => ['required'],
    //         'password' => ['required'],
    //     ]);

    //     $check = $request->only('email', 'password');
    //     $remember_me = $request->has('remember_me') ? true : false;

    //     $login = request()->input('email');

    //     $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

    //     request()->merge([$fieldType => $login]);
    //     if (
    //         // Auth::attempt(['mobile' => request('email'), 'password' => request('password')]) ||
    //         // Auth::attempt(['email' => request('email'), 'password' => request('password')]) ||
    //         // Auth::attempt(['name' => request('name'), 'password' => request('password')])|| 
    //         Auth::attempt($credentials, $check, $remember_me)
    //         //  Auth::attempt(['anyOtherField' => request('anyOtherField'), 'password' => request('password')]) 
    //     )
    //     // (Auth::attempt($credentials, $check)) 
    //     {

    //       $data =  $request->session()->regenerate();
    //     //   dd($data);

    //         // //    return 1;
    //         // return redirect()->intended('/')->withSuccess('You have logged In successfully!');
    //         if (Auth::check()) {

    //             $session_id = Session::getId();
    //             // $cartObj = Cart::session('_token')->getContent();

    //             if (Auth::guest()) {
    //                 session()->flash('guest_cart', [
    //                     'session' => $session_id,
    //                     // 'data' => $cartObj
    //                 ]);
    //             }

    //             return redirect()->intended('clist')->withSuccess('You have logged In successfully!');
    //             // dd(Auth::check());
    //             // dd(session()->all());   
    //         }
    //     } else {
    //         return 0;
    //         // return redirect()->intended('/admin')->withSuccess('You have logged In successfully!');
    //         return redirect('login_view')->withError('Invalid Email address or Password');
    //     }
    //     // print_r($request);
    //     // die("dhgf");
    // }
}
