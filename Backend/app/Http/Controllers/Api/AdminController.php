<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller; // <-- 1. Required import
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class AdminController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        try {
            $user = $request->user();

            if (!$user) {
                return response()->json(['message' => 'Unauthenticated.'], 401);
            }

            // 2. Fetch events (checks both created_by and user_id, or gets all if admin views all)
            $query = Event::query();

            // Uncomment if you want admins to only see their own created events:
            // if (\Schema::hasColumn('events', 'created_by')) {
            //     $query->where('created_by', $user->id);
            // } elseif (\Schema::hasColumn('events', 'user_id')) {
            //     $query->where('user_id', $user->id);
            // }

            // 3. Conditionally load reservation counts if the relationship exists
            if (method_exists(Event::class, 'reservations')) {
                $query->withCount('reservations');
            }

            $events = $query->latest()->get();

            // 4. Compute totals safely
            $totalEvents = $events->count();
            $totalReservations = $events->sum('reservations_count' ?? 0);

            return response()->json([
                'events' => $events,
                'stats' => [
                    'total_events' => $totalEvents,
                    'total_reservations' => $totalReservations,
                ],
            ], 200);

        } catch (Throwable $e) {
            // Expose exact exception message to response for quick debugging
            return response()->json([
                'message' => 'Failed to retrieve admin dashboard metrics.',
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ], 500);
        }
    }
}
