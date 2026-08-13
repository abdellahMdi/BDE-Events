export default function StudentEventCard({ event, onReserve, onCancel, isBusy }) {
  const isReserved = Boolean(event.is_reserved);

  return (
    <div className="bg-white rounded-3xl border border-stone-200 p-6 flex flex-col justify-between">
      {/* Top Badge */}
      <div className="flex items-center justify-between mb-4">
        <span className="px-2.5 py-1 bg-amber-100 text-amber-900 rounded-lg text-xs font-bold">
          {event.price ? `${event.price} DH` : 'Gratuit'}
        </span>
        {isReserved ? (
          <span className="px-2.5 py-0.5 bg-emerald-100 text-emerald-800 text-xs font-bold rounded-md">
            Réservé ✓
          </span>
        ) : (
          <span className="text-xs font-semibold text-stone-500">
            {event.places_limite} places restantes
          </span>
        )}
      </div>

      {/* Event Details */}
      <h3 className="text-lg font-bold text-stone-900">{event.title}</h3>
      <p className="text-xs text-stone-500 mb-4 line-clamp-2">{event.description}</p>

      {/* Dynamic Action Button */}
      {isReserved ? (
        <button
          type="button"
          onClick={() => onCancel(event.id)}
          disabled={isBusy}
          className="w-full py-2.5 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-600 border border-rose-200 text-xs font-bold transition-all disabled:opacity-50"
        >
          {isBusy ? 'Traitement...' : 'Annuler la réservation'}
        </button>
      ) : (
        <button
          type="button"
          onClick={() => onReserve(event.id)}
          disabled={isBusy || event.places_limite <= 0}
          className="w-full py-2.5 rounded-xl bg-amber-400 hover:bg-amber-300 text-emerald-950 text-xs font-bold transition-all disabled:opacity-50"
        >
          {isBusy ? 'Traitement...' : 'Réserver ma place'}
        </button>
      )}
    </div>
  );
}