<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class AccessController extends Controller
{
    public function login(Request $request)
    {
        if (auth()->attempt($request->all())) {
            return response([
                'user' => auth()->user(),
                'access_token' => auth()->user()->createToken('authToken')->accessToken
            ], Response::HTTP_OK);
        }


        return response([
            'message' => 'This User does not exist'
        ], Response::HTTP_UNAUTHORIZED);
    }
}
