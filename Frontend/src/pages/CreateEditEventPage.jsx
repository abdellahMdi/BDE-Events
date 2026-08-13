import { useState, useEffect } from 'react';
import { useNavigate, useParams } from 'react-router-dom';
import AdminHeader from '../components/AdminHeader';
import EventForm from '../components/EventForm';
import api from '../api/axios';

export default function CreateEditEventPage() {
  const { id } = useParams();
  const navigate = useNavigate();
  const isEditing = Boolean(id);

  const [formData, setFormData] = useState({
    title: '',
    description: '',
    date: '',
    houre: '',
    place: '',
    price: '',
    places_limite: '',
  });

  const [errors, setErrors] = useState({});
  const [submitting, setSubmitting] = useState(false);
  const [loading, setLoading] = useState(isEditing);

  // Helper to ensure dates strictly match YYYY-MM-DD format for <input type="date">
  const formatDateForInput = (dateStr) => {
    if (!dateStr) return '';
    return dateStr.split('T')[0].split(' ')[0];
  };

  useEffect(() => {
    if (isEditing) {
      fetchEvent();
    }
  }, [id]);

  const fetchEvent = async () => {
    try {
      const res = await api.get(`/events/${id}`);
      const event = res.data.event || res.data;

      setFormData({
        title: event.title || '',
        description: event.description || '',
        date: formatDateForInput(event.date), // Cleans 2026-08-30T00:00:00.000000Z -> 2026-08-30
        houre: event.houre || '',
        place: event.place || '',
        price: event.price ?? '',
        places_limite: event.places_limite ?? '',
      });
    } catch (err) {
      console.error('Error fetching event details:', err);
    } finally {
      setLoading(false);
    }
  };

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData((prev) => ({ ...prev, [name]: value }));
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    setSubmitting(true);
    setErrors({});

    // Clean payload before submitting to backend
    const payload = {
      ...formData,
      date: formatDateForInput(formData.date),
    };

    try {
      if (isEditing) {
        await api.put(`/admin/events/${id}`, payload);
      } else {
        await api.post('/admin/events', payload);
      }
      navigate('/admin/dashboard');
    } catch (err) {
      if (err.response && err.response.data.errors) {
        console.log('Laravel Validation Errors:', err.response.data.errors);
        setErrors(err.response.data.errors);
      } else {
        alert(err.response?.data?.message || 'Erreur lors de la sauvegarde.');
      }
    } finally {
      setSubmitting(false);
    }
  };

  if (loading) {
    return (
      <div className="min-h-screen bg-stone-100 flex items-center justify-center text-stone-500 font-semibold text-sm">
        Chargement de l'événement...
      </div>
    );
  }

  return (
    <div className="bg-stone-100 min-h-screen">
      <AdminHeader />
      <main className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-6">
        <div>
          <h1 className="text-3xl font-black text-stone-900">
            {isEditing ? 'Modifier l’événement' : 'Créer un nouvel événement'}
          </h1>
          <p className="text-xs text-stone-500">
            {isEditing
              ? 'Mettez à jour les informations de cet événement.'
              : 'Remplissez les informations ci-dessous pour publier un événement.'}
          </p>
        </div>

        <EventForm
          formData={formData}
          onChange={handleChange}
          onSubmit={handleSubmit}
          errors={errors}
          isEditing={isEditing}
          submitting={submitting}
        />
      </main>
    </div>
  );
}