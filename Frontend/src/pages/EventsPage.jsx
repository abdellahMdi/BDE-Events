import { useState, useEffect } from 'react';
import api from '../api/axios';

export default function EventsPage() {
  const [events, setEvents] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const fetchEvents = async () => {
      try {
        const response = await api.get('/events');
        
        // Extract array across various response formats
        const rawData = response.data;
        const eventArray = Array.isArray(rawData)
          ? rawData
          : rawData.events || rawData.data || [];

        setEvents(eventArray);
      } catch (error) {
        console.error('Error loading events:', error);
        setEvents([]);
      } finally {
        setLoading(false);
      }
    };

    fetchEvents();
  }, []);

  if (loading) {
    return <div className="p-8 text-center text-stone-500">Chargement des événements...</div>;
  }

  return (
    <div className="p-8 max-w-6xl mx-auto">
      <h1 className="text-2xl font-bold mb-6">Événements disponibles</h1>
      {events.length === 0 ? (
        <p className="text-stone-500 text-sm">Aucun événement disponible.</p>
      ) : (
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
          {events.map((event) => (
            <div key={event.id} className="p-4 border rounded-xl bg-white shadow-sm space-y-2">
              <h3 className="font-bold text-stone-800">{event.title}</h3>
              <p className="text-xs text-stone-500">{event.description}</p>
            </div>
          ))}
        </div>
      )}
    </div>
  );
}