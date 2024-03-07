<?php

namespace App\Http\Controllers\Api\Event;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EvantApply;

class EventApplyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $evantApply = EvantApply::all();

        if(!auth()->user()){
            return response()->json([
                'status'=>true,
                'evantApply' => 'Please Login',
            ],401);
        }
        return response()->json([
            'status'=>true,
            'evantApply' => $evantApply,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'email' => 'required',
        ]);
        try{
            $evantApply = EvantApply::create([
                'user_id'=> '2',//auth()->user()->id,
                'event_id'=> $request->event_id,
                'phone'=> $request->phone,
                'email'=> $request->email,
            ]);

            return response()->json([
                'status' => true,
                'ApplyDetails'=> $evantApply,
                'message' => 'Registration Successful.',
            ]);
        }catch(error){
            return response()->json([
                'status' => false,
                'message' => 'Registration Not Successful!!!.',
            ]);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $evantApply = EvantApply::where('user_id',$id)->get();
        return response()->json([
            'status' => true,
            'ApplyDetails'=> $evantApply,
            'message' => 'Registration Successful.',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
