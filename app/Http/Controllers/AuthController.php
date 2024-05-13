<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\traits\apitrait;
use App\Http\Requests\UserRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use apitrait;
    public function register(UserRequest $request){
      $user = $request->validated();
    
        $user = User::create([
            'name' => $user['name'],
            'email' => $user['email'],
            'password' => Hash::make($user['password']),
        ]);
    
        $token = $user->createToken('authToken')->plainTextToken;
    
        return $this->apiresponse(new UserResource($user),$token,'register successfully',200);
    }
    public function login(LoginRequest $request){
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }
    
        $user = User::where('email', $request['email'])->firstOrFail();
    
        $token = $user->createToken('authToken')->plainTextToken;
    
       return $this->apicostum($token,200);
    }
    public function logout(Request $request)
{
    
    if ($request->user()) {
        
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    
    return response()->json([
        'message' => 'User not authenticated'
    ], 401);
}


}
