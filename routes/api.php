<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PersonController;
use App\Http\Controllers\API\AuthController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/tokens/create', function (Request $request) {
    $token = $request->user()->createToken($request->token_name);
 
    return ['token' => $token->plainTextToken];
});




Route::prefix('v1/person')->group(function () {
    Route::get('/',[ PersonController::class, 'get']);
    Route::post('/',[ PersonController::class, 'create']);
    Route::delete('/{id}',[ PersonController::class, 'delete']);
    Route::get('/{id}',[ PersonController::class, 'getById']);
    Route::put('/{id}',[ PersonController::class, 'update']);
    Route::post('/login', [AuthController::class, 'login']);
});


Route::get('/oi', function () {
    return view('welcome');
});

Route::get('/teste', function () {
    return response()->json([
        'message' => 'API is working!',
        'status' => 'adess'
    ]);
});
