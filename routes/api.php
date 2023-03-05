<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
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

Route::patch('/v1/category/update/{id}',[CategoryController::class,'update']);
Route::get('/v1/category',[CategoryController::class,'index']);
Route::post('/v1/category',[CategoryController::class, 'store']);
Route::get('/v1/category/{id}',[CategoryController::class,'show']);

Route::patch('/v1/product/update/{id}',[ProductController::class,'update']);
Route::get('/v1/product',[ProductController::class,'index']);
Route::post('/v1/product',[ProductController::class, 'store']);
Route::get('/v1/product/{id}',[ProductController::class,'show']);
Route::delete('/v1/product/{id}',[ProductController::class, 'destroy']);