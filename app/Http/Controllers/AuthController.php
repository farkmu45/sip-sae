<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterPostRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'nis' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('student_nis', $request->nis)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'nis' => [__('auth.failed')],
            ]);
        }

        return [
            'data' =>
            [
                'token' => $user->createToken($request->getClientIp())->plainTextToken
            ]
        ];
    }


    public function register(RegisterPostRequest $request)
    {
        $user = User::create($request->validated());

        return [
            'data' =>
            [
                'token' => $user->createToken($request->getClientIp())->plainTextToken
            ]
        ];
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return [
            'data' => ['message' => 'Berhasil logout']
        ];
    }
}
