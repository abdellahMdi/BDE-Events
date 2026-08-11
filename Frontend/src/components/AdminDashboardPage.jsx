import { useState, useEffect } from 'react';
import api from '../api/axios';
import { useAuth } from '../context/AuthContext';
import AdminNavbar from './AdminNavbar';
import AdminHeroBanner from './AdminHeroBanner';
import AdminStatsGrid from './AdminStatsGrid';
import AdminEventsTable from './AdminEventsTable';

export default function AdminDashboardPage() {
  const { user } = useAuth();
  const [events, setEvents] = useState([]);
  const [stats, setStats] = useState({ totalEvents: 0, totalReservations: 0 });
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    fetchDashboardData();
  }, []);

  const fetchDashboardData = async () => {
    try {
      const res = await api.get('/admin/dashboard');
      setEvents(res.data.events || []);
      setStats({
        totalEvents: res.data.totalEvents ?? res.data.events?.length ?? 0,
        totalReservations: res.data.totalReservations ?? 0,
      });
    } catch (err) {
      console.error('Failed to load dashboard data:', err);
    } finally {
      setLoading(false);
    }
  };

  const handleDeleteEvent = async (eventId) => {
    if (!window.confirm('Êtes-vous sûr de vouloir supprimer cet événement ?')) return;

    try {
      await api.delete(`/admin/events/${eventId}`);
      setEvents((prev) => prev.filter((evt) => evt.id !== eventId));
      setStats((prev) => ({
        ...prev,
        totalEvents: Math.max(0, prev.totalEvents - 1),
      }));
    } catch (err) {
      alert('Une erreur est survenue lors de la suppression.');
    }
  };

  if (loading) {
    return (
      <div className="bg-stone-100 text-stone-800 min-h-screen flex items-center justify-center">
        <p className="text-sm text-stone-500 font-medium">Chargement du tableau de bord...</p>
      </div>
    );
  }

  return (
    <div className="bg-stone-100 text-stone-800 min-h-screen">
      <AdminNavbar />

      <main className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">
        <AdminHeroBanner userName={user?.name} />

        <AdminStatsGrid
          totalEvents={stats.totalEvents}
          totalReservations={stats.totalReservations}
        />

        <AdminEventsTable
          events={events}
          onDelete={handleDeleteEvent}
        />
      </main>
    </div>
  );
}
