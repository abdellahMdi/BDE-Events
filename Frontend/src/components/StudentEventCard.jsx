import { Link } from 'react-router-dom';

export default function StudentEventCard({ event, onReserve, onCancel }) {
  const isReserved = event.is_reserved;

  return (
    <div className="bg-white rounded-3xl border border-stone-200 shadow-sm hover:shadow-md transition-all overflow-hidden flex flex-col justify-between group relative">
      <Link to={`/events/${event.id}`} className="p-6 space-y-4 block flex-1">
        <div className="space-y-3">
          <div className="flex items-center justify-between">
            <span className="px-2.5 py-1 bg-amber-100 text-amber-900 border border-amber-200 rounded-lg text-xs font-extrabold">
              {event.price ? `${event.price} DH` : 'Gratuit'}
            </span>
            {isReserved ? (
              <span className="px-2 py-0.5 bg-emerald-100 text-emerald-800 text-[11px] font-bold rounded-md">
                Réservé ✓
              </span>
            ) : (
              <span className="text-[11px] font-semibold text-stone-500">
                {event.places_limite} places
              </span>
            )}
          </div>
          <div>
            <h3 className="text-lg font-bold text-stone-900 group-hover:text-emerald-800 transition-colors flex items-center justify-between">
              <span>{event.title}</span>
              <svg className="w-4 h-4 text-stone-400 group-hover:text-emerald-800 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 5l7 7-7 7"/>
              </svg>
            </h3>
            <p className="text-xs text-stone-500 mt-1 line-clamp-2">{event.description}</p>
          </div>
        </div>

        <div className="pt-3 border-t border-stone-100">
          <div className="grid grid-cols-2 gap-2 text-xs font-semibold text-stone-600">
            <div className="flex items-center space-x-1.5">
              <svg className="w-3.5 h-3.5 text-emerald-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
              </svg>
              <span>{event.date}</span>
            </div>
            <div className="flex items-center space-x-1.5">
              <svg className="w-3.5 h-3.5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
              </svg>
              <span className="truncate">{event.place}</span>
            </div>
          </div>
        </div>
      </Link>

      <div className="px-6 pb-6 pt-0 z-10">
        {isReserved ? (
          <button
            onClick={() => onCancel(event.id)}
            type="button"
            className="w-full py-2.5 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-600 border border-rose-200 text-xs font-bold transition-all active:scale-[0.98] flex items-center justify-center space-x-1"
          >
            <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
            <span>Annuler la réservation</span>
          </button>
        ) : (
          <button
            onClick={() => onReserve(event.id)}
            type="button"
            className="w-full py-2.5 rounded-xl bg-amber-400 hover:bg-amber-300 text-emerald-950 text-xs font-bold shadow-sm active:scale-[0.98] transition-all"
          >
            Réserver ma place
          </button>
        )}
      </div>
    </div>
  );
}