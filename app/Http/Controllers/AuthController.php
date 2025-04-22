<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function issueToken(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        // Simple fixed auth check
        if ($username === 'admin' && $password === 'password') {
            return response()->json([
                'token' => env('API_TOKEN'),
            ]);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }
}

