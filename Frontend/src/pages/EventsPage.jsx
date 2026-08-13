import { useState, useEffect } from 'react';
import StudentHeader from '../components/StudentHeader';
import StudentHeroBanner from '../components/StudentHeroBanner';
import StudentEventsGrid from '../components/StudentEventsGrid';
import api from '../api/axios';

export default function EventsPage() {
  const [events, setEvents] = useState([]);
  const [loading, setLoading] = useState(true);
  const [actionLoading, setActionLoading] = useState({});

  useEffect(() => {
    fetchEvents();
  }, []);

  const fetchEvents = async () => {
    try {
      const res = await api.get('/events');
      setEvents(res.data.events || res.data || []);
    } catch (err) {
      console.error('Error fetching events:', err);
    } finally {
      setLoading(false);
    }
  };

  const handleReserve = async (eventId) => {
    setActionLoading((prev) => ({ ...prev, [eventId]: true }));

    // 1. Optimistic UI update (Instant feedback)
    setEvents((prevEvents) =>
      prevEvents.map((event) =>
        event.id === eventId
          ? {
              ...event,
              is_reserved: true,
              places_limite: Math.max(0, event.places_limite - 1),
            }
          : event
      )
    );

    try {
      // 2. Call API in background
      await api.post(`/events/${eventId}/reserve`);
    } catch (err) {
      // 3. Rollback locally if API fails
      setEvents((prevEvents) =>
        prevEvents.map((event) =>
          event.id === eventId
            ? {
                ...event,
                is_reserved: false,
                places_limite: event.places_limite + 1,
              }
            : event
        )
      );
      alert(err.response?.data?.message || 'Erreur lors de la réservation.');
    } finally {
      setActionLoading((prev) => ({ ...prev, [eventId]: false }));
    }
  };

  const handleCancel = async (eventId) => {
    setActionLoading((prev) => ({ ...prev, [eventId]: true }));

    // 1. Optimistic UI update (Instant feedback)
    setEvents((prevEvents) =>
      prevEvents.map((event) =>
        event.id === eventId
          ? {
              ...event,
              is_reserved: false,
              places_limite: event.places_limite + 1,
            }
          : event
      )
    );

    try {
      // 2. Call API in background
      await api.delete(`/events/${eventId}/cancel`);
    } catch (err) {
      // 3. Rollback locally if API fails
      setEvents((prevEvents) =>
        prevEvents.map((event) =>
          event.id === eventId
            ? {
                ...event,
                is_reserved: true,
                places_limite: Math.max(0, event.places_limite - 1),
              }
            : event
        )
      );
      alert(err.response?.data?.message || 'Erreur lors de l’annulation.');
    } finally {
      setActionLoading((prev) => ({ ...prev, [eventId]: false }));
    }
  };

  return (
    <div className="bg-stone-100 text-stone-800 min-h-screen">
      <StudentHeader />

      <main className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">
        <StudentHeroBanner eventsCount={events.length} />

        <div className="flex items-center justify-between pt-2">
          <div>
            <h2 className="text-xl font-bold text-stone-900">Événements à venir</h2>
            <p className="text-xs text-stone-500">
              Cliquez sur un événement pour consulter ses informations détaillées.
            </p>
          </div>
        </div>

        {loading ? (
          <div className="py-16 text-center text-stone-500 font-semibold text-sm">
            Chargement des événements...
          </div>
        ) : (
          <StudentEventsGrid
            events={events}
            onReserve={handleReserve}
            onCancel={handleCancel}
            actionLoading={actionLoading}
          />
        )}
      </main>
    </div>
  );
}