<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use App\Models\Role;
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

        $developerRole = Role::where('slug','developer')->first();

        DB::beginTransaction();
        try {

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            $user->roles()->attach( $developerRole->id );

            DB::commit();

            $success = true;
            $message = "Registration successfully";
        } catch (\Exception $e) {
            //Para retroceder la insercion de datos
            DB::rollback();

            $success = false;
            $message = "Registration failed";
            $user = 'fallo';
        }

        $response = [
            'success' => $success,
            'message' => $message,
            'user' => $user
        ];

        return response()->json( $response );
    }
}
