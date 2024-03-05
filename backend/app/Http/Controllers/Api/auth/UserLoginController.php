<?php

namespace App\Http\Controllers\Api\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;
use App\Models\User;


class UserLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if(!$user || !\Hash::check($request->password, $user->password)){
            return response()->json([
                'message' => 'Cradintials are incorrect.',
            ], 401);
        }

        $token = $user->createToken('auth_token',['role:user'])->plainTextToken;
        return response()->json([
            'access_token'=>$token,
            'token_type'=>'Bearer',
        ],200);
    }
}
