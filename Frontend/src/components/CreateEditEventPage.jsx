import { useState, useEffect } from 'react';
import { useParams, useNavigate } from 'react-router-dom';
import api from '../api/axios';
import AdminHeader from '../components/AdminHeader';
import PageBanner from '../components/PageBanner';
import EventForm from '../components/EventForm';

export default function CreateEditEventPage() {
  const { id } = useParams();
  const isEditing = Boolean(id);
  const navigate = useNavigate();

  const [formData, setFormData] = useState({
    title: '',
    place: '',
    date: '',
    houre: '',
    price: '',
    places_limite: '',
    description: '',
  });

  const [errors, setErrors] = useState({});
  const [loading, setLoading] = useState(isEditing);
  const [submitting, setSubmitting] = useState(false);

  // Fetch event data if editing
  useEffect(() => {
    if (isEditing) {
      api
        .get(`/events/${id}`)
        .then((res) => {
          const evt = res.data.event;
          setFormData({
            title: evt.title || '',
            place: evt.place || '',
            date: evt.date || '',
            houre: evt.houre || '',
            price: evt.price || '',
            places_limite: evt.places_limite || '',
            description: evt.description || '',
          });
        })
        .catch((err) => {
          console.error('Error fetching event details:', err);
          navigate('/admin/dashboard');
        })
        .finally(() => setLoading(false));
    }
  }, [id, isEditing, navigate]);

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData((prev) => ({ ...prev, [name]: value }));
    if (errors[name]) {
      setErrors((prev) => ({ ...prev, [name]: null }));
    }
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    setSubmitting(true);
    setErrors({});

    try {
      if (isEditing) {
        await api.put(`/admin/events/${id}`, formData);
      } else {
        await api.post('/admin/events', formData);
      }
      navigate('/admin/dashboard');
    } catch (err) {
      if (err.response && err.response.status === 422) {
        setErrors(err.response.data.errors || {});
      } else {
        alert('Une erreur est survenue lors de l\'enregistrement.');
      }
    } finally {
      setSubmitting(false);
    }
  };

  if (loading) {
    return (
      <div class="bg-stone-100 text-stone-800 min-h-screen flex items-center justify-center">
        <p class="text-sm text-stone-500 font-medium">Chargement de l'événement...</p>
      </div>
    );
  }

  return (
    <div class="bg-stone-100 text-stone-800 min-h-screen">
      <AdminHeader />

      <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">
        <PageBanner
          title={isEditing ? "Modifier l'événement" : 'Créer un événement'}
          subtitle="Remplissez les détails ci-dessous pour publier votre événement."
        />

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
