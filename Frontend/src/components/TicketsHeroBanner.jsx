export default function TicketsHeroBanner({ ticketCount = 0 }) {
  return (
    <div className="bg-emerald-900 rounded-3xl p-6 sm:p-10 text-white shadow-xl flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6 relative overflow-hidden">
      <div className="absolute -right-12 -bottom-12 w-64 h-64 bg-emerald-800/40 rounded-full blur-2xl"></div>
      <div className="absolute left-1/3 -top-12 w-48 h-48 bg-amber-500/10 rounded-full blur-xl"></div>

      <div className="space-y-1 z-10">
        <span className="inline-flex items-center px-3 py-1 bg-emerald-800/80 text-amber-300 text-xs font-semibold uppercase tracking-wider rounded-full border border-emerald-700/50 mb-2">
          Réservations
        </span>
        <h1 className="text-2xl sm:text-4xl font-extrabold tracking-tight">
          Mes Tickets
        </h1>
        <p className="text-emerald-200/80 text-sm">Consultez et présentez vos billets d'accès aux événements.</p>
      </div>

      <div className="z-10 px-5 py-3 rounded-2xl bg-emerald-800/90 border border-emerald-700 text-center flex sm:flex-col items-center justify-between w-full sm:w-auto">
        <span className="text-xs font-semibold uppercase tracking-wider text-emerald-200">Total Billets</span>
        <span className="text-2xl sm:text-3xl font-black text-amber-300 ml-2 sm:ml-0">{ticketCount}</span>
      </div>
    </div>
  );
}