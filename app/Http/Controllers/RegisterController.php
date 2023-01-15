<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        DB::transaction(function() use($request) {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'phone_number' => 'required|string|unique:users',
                'password' => ['required', 'confirmed'],
            ]);
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'email' => $request->phone_number,
                'password' => Hash::make($request->password)
            ]);
        });

        return response(Response::HTTP_OK);
    }

}
