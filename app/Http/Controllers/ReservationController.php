<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Reservation;
use App\Models\Ticket;
use Illuminate\Http\Request;
class ReservationController extends Controller
{
    public function ReservePlace(Request $request){
    $reserve=Reservation::where("user_id",$request->user()->id)->where("event_id",$request->event_id)->first();
    $event = Event::findOrFail($request->event_id);
    if(!$reserve){
         $reservation = Reservation::create([
        "user_id" => $request->user()->id,
        "event_id" => $request->event_id,
        "reserved_at" => now(),
        ]);
        Ticket::create([
            "reservation_id" => $reservation->id,
            "ticket_code" =>  $event->title."-".time(),
        ]);
        $event->decrement('places_limite');
        return redirect()->route('dashboardStudent');
    }else{
        $ticket=Ticket::where("reservation_id",$reserve->id)->first();
        $ticket->delete();
        $reserve->delete();
        $event->increment('places_limite');
        return redirect()->route('dashboardStudent');
    }
    }
}