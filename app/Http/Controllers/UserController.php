<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Artisan;


class UserController extends Controller
{
    public function login(Request $request){
        $this->validate($request, [
            'user' => 'required',
            'password' => 'required'
        ]);
        if (strpos($request->user, '@') !== false){
            $exist = User::where('email', $request->user)->first();
        } else {
            $exist = User::where('username', $request->user)->first();
        }
        if (!$exist){
            return ['Username tidak ada!'];
        }
        if ($request->password === $exist->password){
            Artisan::call('cache:clear');
            $token = $exist->createToken('token-name');
        } else {
            return ['Password salah!'];
        }
        $tokenName = $request->device_name ?? $request->header('user-agent', 'unknown');
        return ([
            'message' => 'Use the token to send messages',
            'token' => $exist->createToken($tokenName)->plainTextToken,
        ]);
   }

   public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return ([
            'message' => 'Successfully logged out!'
        ]);
    }

}
