<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{

    public function displayEvent()
    {
        // Fetch events eager-loading the creator relationship
        $events = Event::with('creator')->get();

        return response()->json([
            'events' => $events,
        ], 200);
    }

   
}
