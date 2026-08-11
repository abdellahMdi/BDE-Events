import TicketCard from './TicketCard';

export default function TicketsGrid({ tickets }) {
  if (!tickets || tickets.length === 0) {
    return (
      <div className="col-span-full bg-white rounded-3xl border border-stone-200 p-12 text-center shadow-sm space-y-4">
        <div className="w-16 h-16 bg-emerald-50 text-emerald-800 rounded-2xl flex items-center justify-center mx-auto border border-emerald-100">
          <svg className="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.5" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 002 2 2 2 0 010 4 2 2 0 00-2 2v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 00-2-2 2 2 0 010-4 2 2 0 002-2V7a2 2 0 00-2-2H5z" />
          </svg>
        </div>
        <div>
          <h3 className="text-base font-bold text-stone-900">Aucun ticket trouvé</h3>
          <p className="text-xs text-stone-500 mt-1">Vous n'avez pas encore réservé de places pour un événement.</p>
        </div>
      </div>
    );
  }

  return (
    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      {tickets.map((ticket) => (
        <TicketCard key={ticket.id} ticket={ticket} />
      ))}
    </div>
  );
}