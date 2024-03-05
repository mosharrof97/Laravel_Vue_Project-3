<?php

namespace App\Http\Controllers\Api\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;
use App\Models\Admin;



class adminLoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'email'=> ['required','email','max:255', Rule::exists(Admin::class,'email')],
            'password'=> ['required','string','min:6'],
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            // throw ValidationException::withMessages([
            //     'email' => ['The provided credentials are incorrect.'],
            // ], 401);
            return response()->json([
                'message' => 'Cradintials are incorrect.',
            ], 401);
        }
        $token = $admin->createToken('auth_token', ['role:admin'])->plainTextToken;
        return response()->json([
            'admin' => $admin,
            'token' => $token,
        ], 200);

    }

}
