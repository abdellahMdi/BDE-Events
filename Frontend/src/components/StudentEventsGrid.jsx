import StudentEventCard from './StudentEventCard';

export default function StudentEventsGrid({ events, onReserve, onCancel }) {
  if (!events || events.length === 0) {
    return (
      <div className="col-span-full py-16 text-center bg-white rounded-3xl border border-stone-200 shadow-sm space-y-3">
        <div className="w-14 h-14 mx-auto bg-emerald-50 text-emerald-800 rounded-2xl flex items-center justify-center border border-emerald-100">
          <svg className="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
          </svg>
        </div>
        <div>
          <h3 className="text-base font-bold text-stone-900">Aucun événement disponible</h3>
          <p class="text-xs text-stone-500 mt-1">Revenez plus tard pour voir les nouveaux événements organisés.</p>
        </div>
      </div>
    );
  }

  return (
    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 items-stretch">
      {events.map((event) => (
        <StudentEventCard
          key={event.id}
          event={event}
          onReserve={onReserve}
          onCancel={onCancel}
        />
      ))}
    </div>
  );
}