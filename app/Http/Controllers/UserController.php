<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Actions\User\UpdateUserDetailsAction;
use App\Actions\User\UpdateUserPasswordAction;

class UserController extends Controller
{
    public function me(){
        // return Auth::user();
        return new UserResource(Auth::user());
    }

    public function changePassword( Request $request,UpdateUserPasswordAction $updateUserPasswordAction){

        if( $updateUserPasswordAction->run( $request->all() , Auth::id() ) ){
            return response()->json([ "success" => true]);
        }

        return response()->json([ "success" => false]);
    }
    public function changeDetails( Request $request, UpdateUserDetailsAction $updateUserDetailsAction ){

        if( $updateUserDetailsAction->run($request->all(), Auth::id() ) ){
            return response()->json([ "success" => true ]);
        }

        return response()->json([ "success" => false ]);
    }
}
