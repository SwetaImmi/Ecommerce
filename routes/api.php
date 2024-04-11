<?php

use App\Http\Controllers\TestApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/tokens', function (Request $request) {
    $token = $request->user()->createToken($request->token_name);
 
    return ['token' => $token->plainTextToken];
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [TestApiController::class, 'get_table_record']);
    Route::get('user/list/{id}', [TestApiController::class, 'edit']);
    Route::post('update/{id}', [TestApiController::class, 'update_post']);
    Route::get('delete/{id}', [TestApiController::class, 'destroy']);
    Route::post('/logout', [TestApiController::class, 'logout']);
    Route::post('product_add_api', [TestApiController::class, 'product_add_api']);
});

// Route::middleware('auth.jwt')->group(function() {
//     Route::get('user',[TestApiController::class,'get_table_record']);
//     Route::get('user/list/{id}',[TestApiController::class,'edit']);
//     Route::post('update/{id}',[TestApiController::class,'update_post']);
//     Route::get('delete/{id}',[TestApiController::class,'destroy']);
//     Route::post('/logout', [TestApiController::class, 'logout']);

// });
Route::post('create_user', [TestApiController::class, 'create_user']);
Route::post('login_user', [TestApiController::class, 'login_user']);
// Route::get('test',[TestApiController::class,'test']);


