import { useState, useEffect } from 'react';
import api from '../api/axios';
import StudentHeader from '../components/StudentHeader';
import StudentHeroBanner from '../components/StudentHeroBanner';
import StudentEventsGrid from '../components/StudentEventsGrid';

export default function StudentDashboardPage() {
  const [events, setEvents] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    fetchEvents();
  }, []);

  const fetchEvents = async () => {
    try {
      const res = await api.get('/events');
      setEvents(res.data.events || []);
    } catch (err) {
      console.error('Error fetching events:', err);
    } finally {
      setLoading(false);
    }
  };

  const handleReserve = async (eventId) => {
    try {
      await api.post(`/events/${eventId}/reserve`);
      setEvents((prev) =>
        prev.map((evt) =>
          evt.id === eventId ? { ...evt, is_reserved: true } : evt
        )
      );
    } catch (err) {
      alert(err.response?.data?.message || 'Erreur lors de la réservation.');
    }
  };

  const handleCancel = async (eventId) => {
    try {
      await api.delete(`/events/${eventId}/reserve`);
      setEvents((prev) =>
        prev.map((evt) =>
          evt.id === eventId ? { ...evt, is_reserved: false } : evt
        )
      );
    } catch (err) {
      alert(err.response?.data?.message || 'Erreur lors de l\'annulation.');
    }
  };

  if (loading) {
    return (
      <div className="bg-stone-100 text-stone-800 min-h-screen flex items-center justify-center">
        <p className="text-sm text-stone-500 font-medium">Chargement des événements...</p>
      </div>
    );
  }

  return (
    <div className="bg-stone-100 text-stone-800 min-h-screen">
      <StudentHeader />

      <main className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">
        <StudentHeroBanner eventCount={events.length} />

        <div className="flex items-center justify-between pt-2">
          <div>
            <h2 className="text-xl font-bold text-stone-900">Événements à venir</h2>
            <p className="text-xs text-stone-500">
              Cliquez sur un événement pour consulter ses informations détaillées.
            </p>
          </div>
        </div>

        <StudentEventsGrid
          events={events}
          onReserve={handleReserve}
          onCancel={handleCancel}
        />
      </main>
    </div>
  );
}