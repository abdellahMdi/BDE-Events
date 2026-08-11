export default function AdminStatsGrid({ totalEvents = 0, totalReservations = 0 }) {
  return (
    <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

      {/* Total Events */}
      <div className="bg-white p-6 rounded-3xl border border-stone-200 shadow-sm flex items-center justify-between hover:border-emerald-200 transition-all">
        <div className="space-y-1">
          <p className="text-xs font-bold text-stone-400 uppercase tracking-wider">Total Événements</p>
          <h3 className="text-3xl font-black text-stone-900">{totalEvents}</h3>
        </div>
        <div className="w-12 h-12 bg-emerald-50 text-emerald-800 rounded-2xl flex items-center justify-center border border-emerald-100">
          <svg className="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
          </svg>
        </div>
      </div>

      {/* Total Reservations */}
      <div className="bg-white p-6 rounded-3xl border border-stone-200 shadow-sm flex items-center justify-between hover:border-emerald-200 transition-all">
        <div className="space-y-1">
          <p className="text-xs font-bold text-stone-400 uppercase tracking-wider">Total Réservations</p>
          <h3 className="text-3xl font-black text-stone-900">{totalReservations}</h3>
        </div>
        <div className="w-12 h-12 bg-amber-50 text-amber-700 rounded-2xl flex items-center justify-center border border-amber-100">
          <svg className="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 002 2 2 2 0 010 4 2 2 0 00-2 2v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 00-2-2 2 2 0 010-4 2 2 0 002-2V7a2 2 0 00-2-2H5z" />
          </svg>
        </div>
      </div>

      {/* System Status */}
      <div className="bg-white p-6 rounded-3xl border border-stone-200 shadow-sm flex items-center justify-between sm:col-span-2 lg:col-span-1 hover:border-emerald-200 transition-all">
        <div className="space-y-1">
          <p className="text-xs font-bold text-stone-400 uppercase tracking-wider">Statut du Système</p>
          <div className="flex items-center space-x-2 pt-1">
            <span className="w-3 h-3 bg-emerald-500 rounded-full animate-ping"></span>
            <span className="text-base font-bold text-stone-800">Opérationnel</span>
          </div>
        </div>
        <div className="w-12 h-12 bg-stone-100 text-stone-600 rounded-2xl flex items-center justify-center border border-stone-200">
          <svg className="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
        </div>
      </div>

    </div>
  );
}
