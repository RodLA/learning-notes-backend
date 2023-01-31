<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login(UserLoginRequest $request){

        //PART 9 para el resumen
        $credentials = $request->only('email','password');

        if( !Auth::attempt( $credentials ) ){
            return response([
                "message" => "Usuario y/o password incorrecto"
            ],422);
        }

        $accessToken = Auth::user()->createToken('authTestToken')->accessToken;

        return response([
            "user" => $credentials,
            "access_token" => $accessToken
        ]);
    }
    public function register(UserRegisterRequest $request){

        DB::beginTransaction();
        try {

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            DB::commit();

            $success = true;
            $message = "Registration successfully";
        } catch (\Exception $e) {
            //Para retroceder la insercion de datos
            DB::rollback();

            $success = false;
            $message = "Registration failed";
        }

        $response = [
            'success' => $success,
            'message' => $message
        ];

        return response()->json( $response );
    }
}
