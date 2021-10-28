<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    public function login(Request $request)
    {
         $credentials = $request->only('email', 'password');
        
        if(!Auth::attempt($credentials)){
            return response([
                'message' => 'Usuario y o contrasena incorrectos'
            ], 401);
        } 

    //     // $accessToken = User::where('email', $request->email)->first()->createToken('authToken')->accessToken;
    //     $accessToken = User::where('email', $request->email)->first()->createToken('accessToken')->accessToken;

    //     return response([
    //         'user' => Auth::user(),
    //         // 'access_token' => $accessToken
    //         'access_token' => $accessToken
    //     ]);
         
        $response = Http::post('http://localhost:8001' . '/oauth/token', [
                                            // 'grant_type' => 'authorization_code',
                                            // 'client_id' => 'client-id',
                                            // 'client_secret' => 'client-secret',
                                            // 'redirect_uri' => 'http://third-party-app.com/callback',
                                            // 'code' => $request->code,
                                            // "grant_type" => "client_credentials",
                                            // 'user' => $credentials,
                                        
                                            'grant_type' => 'password',
                                            'client_id' => '4',
                                            'client_secret' => 'Xm8MQ2ZxEPPDjtwjo4XbcVa79dCp1qUPbSCbALbz',
                                            'username' => 'desarrollo.back@sycgroup.co',
                                            'password' => 'desarrollo.back',
                                            'scope' => '',
                                        
                                    ]); 
        // $response = Http::get('http://passport-app.com/oauth/token');
    
        return response()->json(['status' => true, 'data' => $response->json()]);
    }
}
