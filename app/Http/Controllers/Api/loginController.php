<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class loginController extends Controller
{
    //
    public function login(Request $request)
    {
if(Auth::attempt($request->only('email','password')))
{
$token=$request->user()->createToken('api');
return [
    'token'=>$token->plainTextToken];

}
    }
}
