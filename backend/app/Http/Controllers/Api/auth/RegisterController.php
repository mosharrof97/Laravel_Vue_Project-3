<?php

namespace App\Http\Controllers\Api\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Mail\EmailVerification;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(['guest']);
    // }
    /**
     * Handle the incoming request.
     */

      // ========== UserRegister============//
    public function userRegister(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $token = $user->createToken('auth_token', ['role:user'])->plainTextToken;

        // Mail::to($user->email)->send(new EmailVerification($user->email));

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'message' => 'User Register Successful',
        ], 201);
    }
    // ========== UserRegister============//

// -----------------------------------------------------------------------//
// -----------------------------------------------------------------------//

    // ========== AdminRegister============//
    public function adminRegister(RegisterRequest $request)
    {
        $user = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $token = $user->createToken('auth_token', ['role:admin'])->plainTextToken;

        // Mail::to($user->email)->send(new EmailVerification($user->email));

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'message' => 'Admin Register Successful',
        ], 201);
    }
    // ========== AdminRegister============//

}
