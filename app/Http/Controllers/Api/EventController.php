<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::latest()->paginate(6);
        return response()->json([
            "response" => [
                "status" => 200,
                "message" => "list data events"
            ],
            "data" => $events
        ], 200);
    }
    public function show($slug)
    {
        $event =  Event::where('slug', $slug)->first();
        if ($event) {
            return response()->json([
                "response" => [
                    "status" => 200,
                    "message" => "detail data event"
                ],
                "data" => $event
            ], 200);
        } else {
            return response()->json([
                "response" => [
                    "status" => 404,
                    "message" => "data event not found!"
                ],
                "data" => null
            ], 404);
        }
    }

    public function EventHomePage()
    {
        $events = Event::latest()->take(5)->get();

        return response()->json([
            "response" => [
                "status" => 200,
                "message" => "list data event homepage"
            ],
            "data" => $events
        ], 200);
    }
}
