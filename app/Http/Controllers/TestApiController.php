<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth as FacadesJWTAuth;

class TestApiController extends Controller
{


  public function __construct()
  {
    // $this->middleware('auth:api', ['except' => ['login_user', 'create_user' ]]);
  }


  public function create_user(Request $request)
  {
    $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users',
      'password' => 'required|string|min:2',
    ]);
    // return $request->all();
    $user = new User();
    $user->mobile   =  rand(1000, 9999);
    $user->name     =  $request->name;
    $user->email    =  $request->email;
    $user->password =  $request->password;
    $user->role     =  $request->role;
    $user->save();

    $token = Auth::guard('api');
    // ->login($user);
    $response = [
      'user' => $user,
      'token' => $token
    ];
    return response($response, 201);
    // return response()->json([
    //   'status' => 'success',
    //   'message' => 'User created successfully',
    //   'user' => $user,
    //   'authorisation' => [
    //     'token' => $token,
    //     'type' => 'bearer',
    //   ]
    // ]);
    // return response()->json($user, 200);
    // return 1;
    // return $request->all();
  }


  public function login_user(Request $request)
  {
    $request->validate([
      'email' => 'required|email',
      'password' => 'required',
    ]);
    // Auth::check()
    // $user = Auth::user();
    $credentials = $request->only('email', 'password');
    $token = Auth::attempt($credentials);
    $user = Auth::user();
    // dd($user);
    try {
      if (!$token = JWTAuth::attempt($credentials)) {
        return response()->json([
          'error' => 'Invalid Credentials'
        ], 401);
      }
    } catch (JWTException $e) {
      return response()->json([
        'error' => 'Could not create token'
      ], 500);
    }
    // dd($user);
    return response()->json([
      'token' => $token,
      'user' => $user,
    ], 200);
  }
 





  public function get_table_record(Request $request)
  {
    // // return $request->all();
    if(Auth()->user()->role == 'Admin'){
      $result = User::all();
      $result->makeHidden([
        'email_verified_at',
        'created_at',
        'updated_at',
        'stripe_id',
        'pm_type',
        'pm_last_four',
        'trial_ends_at',
        // 'role'
      ]);
      return response()->json($result, 200);
    }elseif(Auth()->user()->role == 'User'){
      $result = auth('api')->user(); 
      $result->makeHidden([
        'email_verified_at',
        'created_at',
        'updated_at',
        'stripe_id',
        'pm_type',
        'pm_last_four',
        'trial_ends_at',
        // 'role'
      ]);
      return response()->json(['result' => $result], 200);
      // return response()->json(request()->user());
    }
   

    // }
  }

  public function edit($id)
  {
    $where = ['id' => $id];

    $users = User::where($where)->first();

    return response()->json($users);
  }



  public function destroy(Request $request)
  {
    $users = User::find($request->id)->delete();
    return response()->json($users);
  }


  public function update_post(Request $request)
  {
    $users = User::find($request->id);
    $users->name = $request->name;
    $users->email = $request->email;
    $users->save();

    return response()->json($users);
    if ($users) {
      return response()->json([
        'draw' => intval($request->input('draw')),
        //   'recordsTotal' => intval($totalData),
        //   'recordsFiltered' => intval($totalFiltered),
        'code' => 200,
        'data' => $users,
      ]);
    } else {
      return response()->json([
        'message' => 'Internal Server Error',
        'code' => 500,
        'data' => [],
      ]);
    }
  }



  public function logout()
  {
    $token = JWTAuth::getToken();

    // invalidate token
    $invalidate = JWTAuth::invalidate($token);

    if ($invalidate) {
      return response()->json([
        'meta' => [
          'code' => 200,
          'status' => 'success',
          'message' => 'Successfully logged out',
        ],
        'data' => [],
      ]);
    }
    // $user = auth('api')->user();
    // return response()->json(['user'=>$user], 201);
    // $user = auth('api')->user();
    // return response()->json(['user' => $user], 201);
  }


  public function test()
  {
    $users =   User::all();
    return response()->json($users);
  }
}
