import { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import api from '../api/axios';
import { useAuth } from '../Context/AuthContext';

export default function EventsPage() {
  const [events, setEvents] = useState([]);
  const [loading, setLoading] = useState(true);
  const { logout, user } = useAuth();

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
    try {
      await api.post(`/reserve/${eventId}`);
      alert('Réservation effectuée avec succès !');
      fetchEvents();
    } catch (err) {
      alert(err.response?.data?.message || 'Erreur lors de la réservation.');
    }
  };

  if (loading) {
    return (
      <div className="min-h-screen bg-stone-100 flex items-center justify-center text-stone-500 font-semibold text-sm">
        Chargement des événements...
      </div>
    );
  }

  return (
    <div className="min-h-screen bg-stone-100 text-stone-800">
      <header className="bg-white border-b border-stone-200 sticky top-0 z-30">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
          <div className="flex items-center space-x-3">
            <div className="w-9 h-9 bg-amber-400 text-emerald-950 rounded-xl flex items-center justify-center font-black text-lg shadow-sm">
              E
            </div>
            <span className="font-bold text-base tracking-wide text-stone-900">Campus Events</span>
          </div>

          <div className="flex items-center space-x-3">
            <Link
              to="/my-tickets"
              className="px-3.5 py-2 rounded-xl bg-stone-100 hover:bg-stone-200 text-stone-700 text-xs font-semibold border border-stone-200"
            >
              Mes Tickets
            </Link>
            <button
              onClick={logout}
              className="px-3.5 py-2 rounded-xl bg-stone-100 hover:bg-rose-50 text-stone-600 hover:text-rose-600 border border-stone-200 text-xs font-semibold"
            >
              Déconnexion
            </button>
          </div>
        </div>
      </header>

      <main className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">
        <div>
          <h1 className="text-3xl font-black text-stone-900">Événements à Venir</h1>
          <p className="text-xs text-stone-500">Découvrez et réservez vos places pour les prochains événements de votre campus.</p>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          {events.map((event) => (
            <div key={event.id} className="bg-white rounded-3xl border border-stone-200 p-6 flex flex-col justify-between space-y-4 shadow-sm hover:shadow-md transition-shadow">
              <div className="space-y-3">
                <div className="flex justify-between items-start">
                  <h2 className="text-lg font-black text-stone-900">{event.title}</h2>
                  <span className="px-3 py-1 bg-amber-100 text-amber-800 text-[10px] font-bold uppercase tracking-wider rounded-full border border-amber-200">
                    {event.price > 0 ? `${event.price} DH` : 'Gratuit'}
                  </span>
                </div>

                <p className="text-xs text-stone-500 line-clamp-2">{event.description}</p>

                <div className="text-xs font-semibold text-stone-600 space-y-1 pt-2">
                  <p>📍 {event.place}</p>
                  <p>📅 {event.date} - {event.houre}</p>
                  <p className="text-emerald-700 font-bold">
                    🎟️ {event.places_limite} places restantes
                  </p>
                </div>
              </div>

              <button
                onClick={() => handleReserve(event.id)}
                disabled={event.places_limite <= 0}
                className="w-full py-2.5 bg-emerald-900 hover:bg-emerald-950 disabled:bg-stone-300 text-white font-bold rounded-xl text-xs transition-all shadow-sm"
              >
                {event.places_limite > 0 ? 'Réserver' : 'Complet'}
              </button>
            </div>
          ))}
        </div>
      </main>
    </div>
  );
}