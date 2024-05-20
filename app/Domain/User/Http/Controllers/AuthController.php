<?php

namespace App\Domain\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        Log::info('PASSPORT_CLIENT_ID: ' . env('PASSPORT_CLIENT_ID'));
        Log::info('PASSPORT_CLIENT_SECRET: ' . env('PASSPORT_CLIENT_SECRET'));

        $params = [
            'grant_type' => 'password',
            'client_id' => config('passport.client_id'),
            'client_secret' => config('passport.client_secret'),
            'username' => $request->email,
            'password' => $request->password,
            'scope' => '',
        ];

        Log::info('Request params: ', $params);

        $response = Http::asForm()->post(config('app.url') . '/oauth/token', $params);


        Log::info('Response status: ' . $response->status());
        Log::info('Response body: ' . $response->body());

        if ($response->successful()) {
            return response()->json(['token' => $response->json()['access_token']], 200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
}
