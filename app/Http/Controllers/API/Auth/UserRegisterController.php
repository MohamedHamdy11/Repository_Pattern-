<?php

namespace App\Http\Controllers\API\Auth;

use App\Messaging\SmsGlobalService;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserRegisterController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|min:2|max:60',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6|max:60|confirmed'
        ]);
        $data['password'] = bcrypt($request->password);
        $user = User::create($data);
        $token = JWTAuth::fromUser($user);
        return response(['status' => 'success', 'user' => $user,
             'message' => 'register successfully', 'access_token' => $token]);
    } // end of register
    
} // end of register
