<?php

use App\Http\Controllers\Api\FamilyController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});

Route::get('families', [FamilyController::class, 'index']);
Route::get('families/{family}', [FamilyController::class, 'show']);
Route::post('families', [FamilyController::class, 'store']);
Route::patch('families/update/{family}', [FamilyController::class, 'update']);
Route::delete('families/delete/{family}', [FamilyController::class, 'destroy']);
