<?php

namespace App\Http\Controllers\API\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserLoginController extends Controller
{

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|min:4|max:60',
            'password' => 'required|min:6|max:60'
        ]);

        if ($token = auth('api')->attempt($request->only('email','password'))) {
            $user = Auth::guard('api')->user();
            return response(['status' => 'success', 'access_token' => $token, 'user' => $user]);
        }
        return response(['status' => 'failed', 'message' => 'wrong username or password'], 401);
    } // end of login
    
} // end of UserLoginController
