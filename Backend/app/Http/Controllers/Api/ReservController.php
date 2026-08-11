<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Reservation;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ReservController extends Controller
{
    public function reservePlace(Request $request, $id)
    {
        $userId = $request->user()->id;
        $event = Event::findOrFail($id);

        // 1. Check if user already booked
        $existingReservation = Reservation::where("user_id", $userId)
            ->where("event_id", $id)
            ->exists();

        if ($existingReservation) {
            return response()->json([
                'message' => 'You have already reserved a spot for this event.',
            ], 400);
        }

        // 2. Check available spots
        if ($event->places_limite <= 0) {
            return response()->json([
                'message' => 'Sorry, this event is fully booked.',
            ], 400);
        }

        // 3. Atomically create reservation, generate ticket, and update seat count
        $ticket = DB::transaction(function () use ($userId, $event) {
            $reservation = Reservation::create([
                "user_id" => $userId,
                "event_id" => $event->id,
                "reserved_at" => now(),
            ]);

            $ticket = Ticket::create([
                "reservation_id" => $reservation->id,
                "ticket_code" => 'BDE-2026-' . strtoupper(Str::random(8)),
            ]);

            $event->decrement('places_limite');

            return $ticket;
        });

        return response()->json([
            'message' => 'Reservation created successfully!',
            'ticket' => $ticket,
            'remaining_places' => $event->fresh()->places_limite,
        ], 201);
    }

    public function cancelReservation(Request $request, $id)
    {
        $userId = $request->user()->id;

        // 1. Locate reservation or throw a 404 JSON error automatically
        $reservation = Reservation::where("user_id", $userId)
            ->where("event_id", $id)
            ->firstOrFail();

        // 2. Perform ticket deletion, reservation removal, and seat restore atomically
        DB::transaction(function () use ($reservation, $id) {
            Ticket::where("reservation_id", $reservation->id)->delete();
            $reservation->delete();
            Event::where('id', $id)->increment('places_limite');
        });

        $event = Event::find($id);

        return response()->json([
            'message' => 'Réservation annulée avec succès.',
            'event_id' => (int) $id,
            'remaining_places' => $event ? $event->places_limite : null,
        ], 200);
    }
}
