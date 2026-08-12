import { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import api from '../api/axios';
import { useAuth } from '../Context/AuthContext';

export default function MyTicketsPage() {
  const [tickets, setTickets] = useState([]);
  const [loading, setLoading] = useState(true);
  const { logout } = useAuth();

  useEffect(() => {
    fetchTickets();
  }, []);

  const fetchTickets = async () => {
    try {
      const res = await api.get('/my-tickets');
      setTickets(res.data.tickets || res.data || []);
    } catch (err) {
      console.error('Error fetching tickets:', err);
    } finally {
      setLoading(false);
    }
  };

  const handleCancelTicket = async (eventId) => {
    if (!window.confirm('Voulez-vous vraiment annuler votre réservation ?')) return;

    try {
      await api.delete(`/cancel/${eventId}`);
      setTickets((prev) => prev.filter((t) => (t.reservation?.event_id || t.event_id) !== eventId));
    } catch (err) {
      alert(err.response?.data?.message || "Impossible d'annuler la réservation.");
    }
  };

  if (loading) {
    return (
      <div className="bg-stone-100 text-stone-800 min-h-screen flex items-center justify-center">
        <p className="text-sm font-semibold text-stone-500">Chargement de vos tickets...</p>
      </div>
    );
  }

  return (
    <div className="bg-stone-100 text-stone-800 min-h-screen">
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
              to="/events"
              className="px-3.5 py-2 rounded-xl bg-stone-100 hover:bg-stone-200 text-stone-700 text-xs font-semibold border border-stone-200"
            >
              Événements
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

      <main className="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">
        <div>
          <h1 className="text-3xl font-black text-stone-900">Mes Tickets</h1>
          <p className="text-xs text-stone-500">Retrouvez toutes vos réservations d'événements ci-dessous.</p>
        </div>

        {tickets.length > 0 ? (
          <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
            {tickets.map((ticket) => {
              const event = ticket.reservation?.event || ticket.event;
              const eventId = event?.id || ticket.event_id;
              return (
                <div key={ticket.id} className="bg-white rounded-3xl border border-stone-200 p-6 flex flex-col justify-between space-y-4 shadow-sm">
                  <div className="space-y-3">
                    <div className="flex justify-between items-start">
                      <h2 className="text-lg font-black text-stone-900">{event?.title || 'Événement'}</h2>
                      <span className="px-3 py-1 bg-amber-100 text-amber-800 text-[10px] font-bold uppercase tracking-wider rounded-full border border-amber-200">
                        Validé
                      </span>
                    </div>

                    <div className="bg-stone-50 rounded-2xl p-4 border border-stone-200/80 space-y-2">
                      <p className="text-[11px] font-bold text-stone-400 uppercase tracking-wider">Code Ticket</p>
                      <p className="font-mono font-bold text-emerald-900 text-sm tracking-wider">
                        {ticket.ticket_code || `BDE-${ticket.id}`}
                      </p>
                    </div>

                    <div className="text-xs font-semibold text-stone-600 space-y-1">
                      <p>📍 {event?.place}</p>
                      <p>📅 {event?.date} - {event?.houre}</p>
                    </div>
                  </div>

                  <button
                    onClick={() => handleCancelTicket(eventId)}
                    className="w-full py-2.5 bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 font-bold rounded-xl text-xs transition-all"
                  >
                    Annuler la Réservation
                  </button>
                </div>
              );
            })}
          </div>
        ) : (
          <div className="bg-white rounded-3xl border border-stone-200 p-12 text-center text-stone-400">
            <p className="text-base font-bold text-stone-700 mb-1">Aucun ticket réservé</p>
            <p className="text-xs text-stone-400 mb-4">Vous n'avez pas encore effectué de réservation.</p>
            <Link
              to="/events"
              className="inline-flex px-5 py-2.5 bg-emerald-900 hover:bg-emerald-950 text-white font-bold text-xs rounded-xl shadow-sm"
            >
              Parcourir les événements
            </Link>
          </div>
        )}
      </main>
    </div>
  );
}