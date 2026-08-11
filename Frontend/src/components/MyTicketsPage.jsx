import { useState, useEffect } from 'react';
import api from '../api/axios';
import TicketsHeader from '../components/TicketsHeader';
import TicketsHeroBanner from '../components/TicketsHeroBanner';
import TicketsGrid from '../components/TicketsGrid';

export default function MyTicketsPage() {
  const [tickets, setTickets] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    fetchTickets();
  }, []);

  const fetchTickets = async () => {
    try {
      const response = await api.get('/my-tickets');
      setTickets(response.data.tickets || response.data);
    } catch (error) {
      console.error('Error fetching tickets:', error);
    } finally {
      setLoading(false);
    }
  };

  if (loading) {
    return (
      <div className="bg-stone-100 text-stone-800 min-h-screen flex items-center justify-center">
        <p className="text-sm text-stone-500 font-medium">Chargement de vos billets...</p>
      </div>
    );
  }

  return (
    <div className="bg-stone-100 text-stone-800 min-h-screen">
      <TicketsHeader />

      <main className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">
        <TicketsHeroBanner ticketCount={tickets.length} />
        <TicketsGrid tickets={tickets} />
      </main>
    </div>
  );
}