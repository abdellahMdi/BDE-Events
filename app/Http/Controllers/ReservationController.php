<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Reservation;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class ReservationController extends Controller
{
    public function reservePlace(Request $request, $id)
    {
        $userId = $request->user()->id;
        $event = Event::findOrFail($id);
        $existingReservation = Reservation::where("user_id", $userId)->where("event_id", $id)->exists();

        if ($existingReservation) {
            return back()->with('error', 'Vous avez déjà réservé pour cet événement.');
        }

        if ($event->places_limite <= 0) {
            return back()->with('error', 'Désolé, cet événement est complet.');
        }

        $reservation = Reservation::create([
            "user_id" => $userId,
            "event_id" => $event->id,
            "reserved_at" => now(),
        ]);

        Ticket::create([
            "reservation_id" => $reservation->id,
            "ticket_code" => 'BDE-2026-' . strtoupper(Str::random(8)),
        ]);

        $event->decrement('places_limite');
        return redirect()->route('dashboardStudent');
    }

    public function cancelReservation(Request $request, $id)
    {
        $userId =$request->user()->id;
        $reservation =Reservation::where("user_id", $userId)->where("event_id", $id)->firstOrFail();
        Ticket::where("reservation_id", $reservation->id)->delete();
        $reservation->delete();
        Event::where('id', $id)->increment('places_limite');
        return redirect()->route('dashboardStudent')->with('success', 'Réservation annulée.');
    }
}