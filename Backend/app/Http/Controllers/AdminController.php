<?php
namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $adminId = auth()->id();
        $events = Event::where("created_by", $adminId)->get();
        $totalReservations = 0;

        foreach ($events as $event) {
            $countForThisEvent = Reservation::where("event_id", $event->id)->count();
            $totalReservations = $totalReservations + $countForThisEvent;
        }

        $totalEvents = count($events);

        return view("admin.dashboardAd", ["events" => $events, "totalReservations" => $totalReservations, "totalEvents" => $totalEvents]);
    }
}
