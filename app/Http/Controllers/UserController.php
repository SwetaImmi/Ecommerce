<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\RelationNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use JWTException;
use JWTAuth;

class UserController extends Controller
{
    /**
     * Register Or Create User
     */
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
        $user->mobile = rand(1000,9999);
        $user->save();
        return redirect('/login')->with('success', 'Item created successfully!');
    }



    /**
     * Login
     */
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

            // dd(Auth::attempt($credentials, $check, $remember_me));

            if (Auth()->user()->role == 'customer') {
                return redirect()->intended('clist')->with('success', 'You have logged In successfully!');
            } else {

                return redirect()->intended('/admin')->with('success', 'You have logged In successfully!');
            }
        } else {
            return back()->with('error', 'Invalid Email address or Password');
        }
    }



    /**
     * Logout function
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
            ->withSuccess('You have logged out successfully!');
    }




    /*

Exception Check

*/

    public function index()
    {
        return view('search');
    }

    // public function result(Request $request)
    // {
    //     try {
    //         // $user = User::findOrFail($request->user_id);
    //         $user = Gallery::with('product')->get();
    //         return view('result', compact('user'));
    //     } catch (ModelNotFoundException $exception) {
    //         return back()->withError('User with ID: '.$request->user_id.' not found!')->withInput();
    //     } catch (RelationNotFoundException $exception) {
    //         return back()->withError($exception->getMessage())->withInput();
    //     }
    // }

    //     public function result(Request $request)
    // {
    //     try {
    //         $user = User::findOrFail($request->user_id);

    //         return view('result', compact('user'));
    //     } catch(Exception $exception) {
    //         $message = $exception->getMessage();

    //         if($exception instanceof ModelNotFoundException) {
    //             $message = 'User with ID: '.$request->user_id.' not found!';
    //         }

    //         return back()->withError($message)->withInput();
    //     }
    // }

    public function result(Request $request)
    {
        $user = User::find($request->user_id);

        return view('result', compact('user'));
    }

    /*

Exception Check

*/
}
