<?php

use App\Http\Controllers\apis\productcontroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserPhonesController;

use App\Http\Controllers\Api\loginController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::resource('phones',UserPhonesController::class)->middleware('auth:sanctum');
Route::post('login',[loginController::class,'login']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('test',function ()
{
   echo 'api';
   return response()->json(['name'=>'ahmed','age'=>'22'],200);
});
Route::get('product',[productcontroller::class,'index']);
Route::get('porduct/edit/{id}',[productcontroller::class,'edit']);
Route::post('porduct/update/{id}',[productcontroller::class,'update']);
Route::get('porduct/create',[productcontroller::class,'create']);
Route::delete('porduct/delete/{id}',[productcontroller::class,'delete']);
Route::post('porduct/store',[productcontroller::class,'store']);
