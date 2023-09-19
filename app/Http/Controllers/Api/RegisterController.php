<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\TeacherDetail;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Illuminate\Database\QueryException;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(RegisterRequest $request)
    {

        try{

            $user = User::create([
                'user_type_id' => $request->user_type,
                'name' => $request->name,
                'email'=>$request->email,
            ]);

            if($request->user_type == 1){
                TeacherDetail::create([
                    'user_id' => $user->id,
                    'years_of_experience' => $request->years_of_experience
                ]);
            }
            $token = $user->createToken('token')->plainTextToken;
            return response()->json([
                'user'=>$user,
                'token'=>$token
            ],201);

        }catch(QueryException $e){
            if ($e->errorInfo[1] === 1062) {
                return response()->json(['message' => 'Email address is already in use.'], 422);
        }
    }




    }
}
