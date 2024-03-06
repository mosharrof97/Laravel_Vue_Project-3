<?php

namespace App\Http\Controllers\Api\Event;
use App\Http\Controllers\Controller;
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
        //
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

        $evantApply = EvantApply::create([
            'user_id'=> auth()->user()->id,
            'event_id'=> $request->event_id,
            'phone'=> $request->phone,
            'email'=> $request->email,
        ]);

        return response()->json([
            'status' => true,
            'ApplyDetails'=> $evantApply,
            'message' => 'Registration Successful.',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
