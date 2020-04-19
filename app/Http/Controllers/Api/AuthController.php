<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function register(Request $request)
    {
       $validatedData = $request -> validate([
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
        ]);

        $validatedData['password'] = bcrypt($request->password);
       $user = User::create($validatedData);
       $accessToken = $user->createToken('authToken')->accessToken;
       return response(['user' => $user,'access_token' => $accessToken]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($loginData))
        {
            return response(['message' => 'Invalid credentials']);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;
        return response(['user' => auth()->user(),'access_token' => $accessToken]);
    }
}
