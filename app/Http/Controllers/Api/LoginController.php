<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request)
    {
        $user = User::where(['email'=>$request->email,'name'=>$request->name])->with('experience')->first();
        // $user = User::where(['email'=>$request->email,'name'=>$request->name])->first();


        if (! $user) {
            throw ValidationException::withMessages([
                'error' => ['The provided credentials are incorrect.'],
            ]);
        }


        return response()->json([
            'user'=>$user,
            'token'=>$user->createToken('token')->plainTextToken
        ]);
    }
}
