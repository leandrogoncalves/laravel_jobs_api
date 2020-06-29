<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Routing\Exception\InvalidParameterException;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        try {
            if (!Auth::attempt($credentials)) {
                throw new InvalidParameterException('Invalid credentials');
            }

            $user = $request->user();

            return response()->json(
                [
                    'name' => $user->name,
                    'email' => $user->email,
                ],
                200,
                [
                    'Authorization' => 'Bearer ' . $user->createToken('token')->accessToken
                ]
            );
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function logout(Request $request)
    {
        $isUser = $request->user()->token()->revoke();
        if ($isUser) {
            return response()->json([
                'messsage' => 'Logout successful'
            ]);
        }

        return response()->json([
            'messsage' => 'Logout error'
        ]);
    }
}
