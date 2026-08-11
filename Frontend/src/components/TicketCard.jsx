export default function TicketCard({ ticket }) {
  const event = ticket?.reservation?.event || ticket?.event;

  return (
    <div className="bg-white rounded-3xl border border-stone-200 shadow-sm hover:shadow-md transition-all overflow-hidden flex flex-col justify-between relative group">
      {/* Top Banner Accent Gradient */}
      <div className="h-2 bg-gradient-to-r from-emerald-800 via-amber-400 to-emerald-800"></div>

      {/* Ticket Main Content */}
      <div className="p-6 space-y-5">
        <div className="flex items-center justify-between border-b border-stone-100 pb-4">
          <div>
            <span className="text-[10px] font-bold uppercase tracking-widest text-stone-400 block">Pass Accès</span>
            <h2 className="text-lg font-black text-stone-900">Ticket #{ticket.id}</h2>
          </div>
          <span className="px-2.5 py-1 bg-emerald-50 text-emerald-800 border border-emerald-200 rounded-lg text-xs font-bold uppercase">
            Valide
          </span>
        </div>

        <div className="space-y-3">
          <div>
            <span className="text-[11px] font-bold uppercase tracking-wider text-stone-400 block mb-0.5">Événement</span>
            <p className="text-base font-bold text-stone-900 leading-snug">
              {event?.title || 'Titre indisponible'}
            </p>
          </div>

          <div className="grid grid-cols-2 gap-4 pt-1">
            <div>
              <span className="text-[11px] font-bold uppercase tracking-wider text-stone-400 block mb-0.5">Date</span>
              <div className="flex items-center text-xs font-semibold text-stone-700 space-x-1.5">
                <svg className="w-3.5 h-3.5 text-emerald-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span>{event?.date || '—'}</span>
              </div>
            </div>

            <div>
              <span className="text-[11px] font-bold uppercase tracking-wider text-stone-400 block mb-0.5">Lieu</span>
              <div className="flex items-center text-xs font-semibold text-stone-700 space-x-1.5">
                <svg className="w-3.5 h-3.5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <span className="truncate">{event?.place || '—'}</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      {/* Ticket Cut-Out Divider */}
      <div className="relative flex items-center my-1">
        <div className="w-4 h-8 bg-stone-100 rounded-r-full border-r border-t border-b border-stone-200"></div>
        <div className="flex-1 border-b-2 border-dashed border-stone-200 mx-2"></div>
        <div className="w-4 h-8 bg-stone-100 rounded-l-full border-l border-t border-b border-stone-200"></div>
      </div>

      {/* Ticket Code and Barcode Footer */}
      <div className="p-6 bg-stone-50/80 pt-2 space-y-2 text-center">
        <span className="text-[10px] font-bold uppercase tracking-wider text-stone-400 block">Code du Ticket</span>

        <div className="py-2 px-3 bg-white border border-stone-200 rounded-xl inline-block shadow-inner w-full">
          <span className="font-mono text-xs font-extrabold tracking-widest text-emerald-950">
            {ticket.ticket_code}
          </span>
        </div>

        <div className="pt-2 flex justify-center items-center space-x-1 opacity-60">
          <div className="w-1 h-6 bg-stone-800"></div>
          <div className="w-0.5 h-6 bg-stone-800"></div>
          <div className="w-1.5 h-6 bg-stone-800"></div>
          <div className="w-0.5 h-6 bg-stone-800"></div>
          <div className="w-1 h-6 bg-stone-800"></div>
          <div className="w-2 h-6 bg-stone-800"></div>
          <div className="w-0.5 h-6 bg-stone-800"></div>
          <div className="w-1.5 h-6 bg-stone-800"></div>
          <div className="w-1 h-6 bg-stone-800"></div>
          <div className="w-0.5 h-6 bg-stone-800"></div>
          <div className="w-2 h-6 bg-stone-800"></div>
        </div>
      </div>
    </div>
  );
}