<?php

namespace App\Http\Controllers\Api\Event;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\EventRequest;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;


class EventController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:sanctum', ['admin']);
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $event = Event::all();
        if (!$event) {
            return response()->json([
                'status' => false,
                'message' => 'event not found',
            ], 404);
        }

        // if (!Auth::user()->is($event)) {
        //     return response()->json([
        //         'status' => false,
        //         'message' => 'Unauthorized',
        //     ], 401);
        // }

        return response()->json([
            'status'=>true,
            'event'=>$event,
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(EventRequest $request)
    {
        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = 'Event_' . time() . '_' . mt_rand(10000, 10000000) . '.' . $request->file('image')->extension();
            $request->file('image')->move(public_path('upload/EventImage'), $imageName);
        }

        try {
            $event = Event::create([
                'title' => $request->title,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'image' => $imageName,
                'description' => $request->description,
            ]);

            $token = $event->createToken('event_token', ['role:admin'])->plainTextToken;

            return response()->json([
                'status' => true,
                'event' => $event,
                'token' => $token,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event = Event::find($id);

        if (!$event) {
            return response()->json([
                'status' => false,
                'message' => 'event not found',
            ], 404);
        }

        // if (!Auth::user()->is($event)) {
        //     return response()->json([
        //         'status' => false,
        //         'message' => 'Unauthorized',
        //     ], 401);
        // }

        $token = $event->createToken('event_view',['role:admin'])->plainTextToken;
        return response()->json([
            'status'=>true,
            'event'=>$event,
            'token'=>$token,

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventRequest $request, string $id)
    {
        $event = Event::find($id);
        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = 'Event_' . time() . '_' . mt_rand(10000, 10000000) . '.' . $request->file('image')->extension();
            $request->file('image')->move(public_path('upload/EventImage'), $imageName);
        }

        try {
            $eventUpdate = $event->update([
                'title' => $request->title,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'image' => $imageName,
                'description' => $request->description,
            ]);

            $token = $eventUpdate->createToken('event_token', ['role:admin'])->plainTextToken;

            return response()->json([
                'status' => true,
                'event' => $eventUpdate,
                'token' => $token,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $event = Event::find($id);
        if(!$event){
            return response()->json([
                'status'=>false,
                'message' => 'Event ID-'.$id.' Is Not Found',
            ],404);
        }
        $event->delete();
        return response()->json([
            'status'=> true,
            'event'=> 'Event ID-'.$event->id,
            'message'=> 'Event ID-'.$event->id.' Delete SuccessFull',
        ]);
    }
}
