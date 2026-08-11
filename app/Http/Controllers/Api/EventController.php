<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller; // Added missing base controller import
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Ticket;

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

    public function displayTicketByUser(Request $request)
    {
        // Use the authenticated user's ID directly from the request for security
        $userId = $request->user()->id;

        $tickets = Ticket::whereHas('reservation', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })
        ->with(['reservation.event']) // Eager load reservation and event details for React cards
        ->get();

        return response()->json([
            'tickets' => $tickets,
        ], 200);
    }

    public function createEvent(Request $request)
    {
        // 1. Enhanced API validation with data types
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'place' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'houre' => ['required'],
            'price' => ['required', 'numeric', 'min:0'],
            'places_limite' => ['required', 'integer', 'min:1'],
            'description' => ['required', 'string'],
        ]);

        // 2. Create event attached to authenticated admin
        $event = Event::create([
            'title' => $validated['title'],
            'place' => $validated['place'],
            'date' => $validated['date'],
            'houre' => $validated['houre'],
            'price' => $validated['price'],
            'places_limite' => $validated['places_limite'],
            'description' => $validated['description'],
            'created_by' => $request->user()->id,
        ]);

        // 3. Return created event with 201 HTTP status
        return response()->json([
            'message' => 'Event created successfully!',
            'event' => $event,
        ], 201);
    }

    public function showEvent($id)
    {
        // Find the event or return a 404 JSON response automatically
        $event = Event::with('creator')->findOrFail($id);

        return response()->json([
            'event' => $event,
        ], 200);
    }

    public function updateEvent(Request $request, $id)
    {
        // 1. Validate inputs with appropriate data types
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'place' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'houre' => ['required'],
            'price' => ['required', 'numeric', 'min:0'],
            'places_limite' => ['required', 'integer', 'min:0'],
            'description' => ['required', 'string'],
        ]);

        // 2. Find event or fail with 404 JSON
        $event = Event::findOrFail($id);

        // 3. Perform update using validated array
        $event->update($validated);

        // 4. Return updated model with 200 OK status
        return response()->json([
            'message' => 'Event updated successfully!',
            'event' => $event->fresh(),
        ], 200);
    }

    public function deleteEvent($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return response()->json([
            'message' => 'Event deleted successfully!',
            'id' => (int) $id,
        ], 200);
    }
}
