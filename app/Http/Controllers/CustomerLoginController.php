<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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

  
}
