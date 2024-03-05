<?php

namespace App\Http\Controllers\Api\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogOutController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            'message'=>'Logout User'
        ],);
    }
}
