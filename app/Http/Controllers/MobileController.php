<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class MobileController extends Controller
{
    function Login(Request $request){
        $user = DB::table('users')
                  ->where('email',$request->email)
                  ->get();
        if($user->count() > 0){
            if(Hash::check($request->password, $user[0]->password)){
                return response()->JSON(['user'=>$user,'message'=>'Log in'],200);
            }
            else{
                return response()->JSON(['user'=>[],'message'=>'Password Not Match'],419);
            }

        }
        else{
            return response()->JSON(['user'=>[],'message'=>'Account Not Found'],419);
        }
    }
}
