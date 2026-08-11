<?php

namespace App\Http\Controllers\Api;

use App\Models\Event;
use App\Models\Reservation;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $adminId = $request->user()->id;

        // 1. Fetch admin events and eager-load reservation counts in a single query (fixes N+1 issue)
        $events = Event::where("created_by", $adminId)
            ->withCount('reservations')
            ->get();

        // 2. Compute aggregate totals in memory without additional database queries
        $totalReservations = $events->sum('reservations_count');
        $totalEvents = $events->count();

        return response()->json([
            'events' => $events,
            'stats' => [
                'total_events' => $totalEvents,
                'total_reservations' => $totalReservations,
            ],
        ], 200);
    }
}
