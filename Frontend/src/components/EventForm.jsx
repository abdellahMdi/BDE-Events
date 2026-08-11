import { Link } from 'react-router-dom';

export default function EventForm({ formData, onChange, onSubmit, errors, isEditing, submitting }) {
  return (
    <div class="bg-white rounded-3xl shadow-sm border border-stone-200 p-6 sm:p-8">
      <form onSubmit={onSubmit} class="space-y-6">

        {/* Title */}
        <div>
          <label htmlFor="title" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-2">
            Titre de l'événement
          </label>
          <input
            type="text"
            name="title"
            id="title"
            value={formData.title}
            onChange={onChange}
            placeholder="ex: Laravel Day"
            required
            class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 text-sm transition-all outline-none bg-stone-50/30"
          />
          {errors.title && <span class="text-xs text-rose-500 mt-1 block font-medium">{errors.title[0]}</span>}
        </div>

        {/* Place */}
        <div>
          <label htmlFor="place" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-2">
            Lieu (Place)
          </label>
          <input
            type="text"
            name="place"
            id="place"
            value={formData.place}
            onChange={onChange}
            placeholder="ex: Beni Mellal"
            required
            class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 text-sm transition-all outline-none bg-stone-50/30"
          />
          {errors.place && <span class="text-xs text-rose-500 mt-1 block font-medium">{errors.place[0]}</span>}
        </div>

        {/* Date & Time */}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
          <div>
            <label htmlFor="date" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-2">
              Date
            </label>
            <input
              type="date"
              name="date"
              id="date"
              value={formData.date}
              onChange={onChange}
              required
              class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 text-sm transition-all outline-none bg-stone-50/30"
            />
            {errors.date && <span class="text-xs text-rose-500 mt-1 block font-medium">{errors.date[0]}</span>}
          </div>
          <div>
            <label htmlFor="houre" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-2">
              Heure
            </label>
            <input
              type="time"
              name="houre"
              id="houre"
              value={formData.houre}
              onChange={onChange}
              required
              class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 text-sm transition-all outline-none bg-stone-50/30"
            />
            {errors.houre && <span class="text-xs text-rose-500 mt-1 block font-medium">{errors.houre[0]}</span>}
          </div>
        </div>

        {/* Price & Seats Limit */}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
          <div>
            <label htmlFor="price" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-2">
              Prix (DH)
            </label>
            <input
              type="number"
              step="0.01"
              name="price"
              id="price"
              value={formData.price}
              onChange={onChange}
              placeholder="0 pour Gratuit"
              class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 text-sm transition-all outline-none bg-stone-50/30"
            />
            {errors.price && <span class="text-xs text-rose-500 mt-1 block font-medium">{errors.price[0]}</span>}
          </div>
          <div>
            <label htmlFor="places_limite" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-2">
              Places Limitées
            </label>
            <input
              type="number"
              name="places_limite"
              id="places_limite"
              value={formData.places_limite}
              onChange={onChange}
              placeholder="ex: 100"
              required
              class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 text-sm transition-all outline-none bg-stone-50/30"
            />
            {errors.places_limite && <span class="text-xs text-rose-500 mt-1 block font-medium">{errors.places_limite[0]}</span>}
          </div>
        </div>

        {/* Description */}
        <div>
          <label htmlFor="description" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-2">
            Description
          </label>
          <textarea
            name="description"
            id="description"
            rows="4"
            value={formData.description}
            onChange={onChange}
            placeholder="Description de l'événement..."
            required
            class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 text-sm transition-all outline-none resize-none bg-stone-50/30"
          ></textarea>
          {errors.description && <span class="text-xs text-rose-500 mt-1 block font-medium">{errors.description[0]}</span>}
        </div>

        {/* Submit Actions */}
        <div class="pt-4 flex items-center justify-end space-x-3">
          <Link
            to="/admin/dashboard"
            class="px-6 py-3 rounded-xl border border-stone-200 text-stone-600 font-semibold text-xs hover:bg-stone-50 transition-all"
          >
            Annuler
          </Link>
          <button
            type="submit"
            disabled={submitting}
            class="px-6 py-3 rounded-2xl bg-amber-400 hover:bg-amber-300 text-emerald-950 font-bold text-xs shadow-md active:scale-[0.98] transition-all disabled:opacity-50"
          >
            {submitting ? 'Chargement...' : isEditing ? 'Mettre à jour' : 'Enregistrer'}
          </button>
        </div>
      </form>
    </div>
  );
}
