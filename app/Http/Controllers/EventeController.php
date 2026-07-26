<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventeController extends Controller
{
    
    public function displayEvent()
    {
        $events = Event::with('creator')->get();
        return view('student.dashboardSt', ['events' => $events]);
    }

    public function displayTicketByUser($id)
    {
        $tickets = Ticket::whereHas('reservation', function ($query) use ($id) {
            $query->where('user_id', $id);
        })->get();

        return view('student.TicketPage', ['tickets' => $tickets]);
    }

    public function createEventPage()
    {
        return view('admin.creatUpdateEvent');
    }

    public function createEvent(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'place' => 'required',
            'date' => 'required',
            'heure' => 'required',
            'price' => 'required',
            'places_limite' => 'required',
            'description' => 'required',
        ]);

        $userId = $request->user()->id;

        Event::create([
            'title' => $request->title,
            'place' => $request->place,
            'date' => $request->date,
            'houre' => $request->heure,
            'price' => $request->price,
            'places_limite' => $request->places_limite,
            'description' => $request->description,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('adminDashboard');
    }

    public function updateEventDisplay($id)
    {
        $event = Event::findOrFail($id);
        return view('admin.creatUpdateEvent', ['event' => $event]);
    }

    public function updateEvent(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'place' => 'required',
            'date' => 'required',
            'heure' => 'required',
            'price' => 'required',
            'places_limite' => 'required',
            'description' => 'required',
        ]);

        $event = Event::findOrFail($id);

        Event::create([
            'title' => $request->title,
            'place' => $request->place,
            'date' => $request->date,
            'houre' => $request->heure,
            'price' => $request->price,
            'places_limite' => $request->places_limite,
            'description' => $request->description,
            'created_by' => Auth::id(),
        ]);
        return redirect()->route('adminDashboard');
    }

    public function showEvent($id)
    {
        $event = Event::findOrFail($id);
        return view('student.showEvent', ['event' => $event]);
    }

    public function deleteEvent($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();
        return redirect()->route('adminDashboard');
    }
}