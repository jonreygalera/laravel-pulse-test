<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
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

Route::middleware('auth:sanctum')->group(function() {
  Route::get('/user', function (Request $request) {
    return $request->user();
  });

  Route::get('/slow-request', function (Request $request) {
    sleep(2);
    return $request->user();
  });

  Route::get('/slow-queries', function (Request $request) {
    
    $result = \App\Models\User::select()->where('name', 'like', '%tes%')->whereRaw(\DB::raw('SLEEP(2)'))->get();
     return response()->json($result, 200);
  });
});

Route::post('/auth/register', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);

