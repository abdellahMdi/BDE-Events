import { Link } from 'react-router-dom';

export default function AdminHeroBanner({ userName }) {
  return (
    <div className="bg-emerald-900 rounded-3xl p-6 sm:p-10 text-white shadow-xl flex flex-col md:flex-row justify-between items-start md:items-center gap-6 relative overflow-hidden">
      <div className="absolute -right-12 -bottom-12 w-64 h-64 bg-emerald-800/40 rounded-full blur-2xl"></div>
      <div className="absolute left-1/3 -top-12 w-48 h-48 bg-amber-500/10 rounded-full blur-xl"></div>

      <div className="space-y-2 z-10 max-w-xl">
        <div className="inline-flex items-center space-x-2 px-3 py-1 bg-emerald-800/80 text-amber-300 text-xs font-semibold uppercase tracking-wider rounded-full border border-emerald-700/50 mb-1">
          <span>Espace Administration</span>
        </div>
        <h1 className="text-2xl sm:text-4xl font-extrabold tracking-tight">
          Welcome Admin, {userName || 'Admin'}
        </h1>
        <p className="text-emerald-200/80 text-sm leading-relaxed">
          Gérez vos événements, suivez les réservations et contrôlez la plateforme en toute simplicité.
        </p>
      </div>

      <div className="z-10 w-full md:w-auto">
        <Link
          to="/admin/events/create"
          className="w-full md:w-auto inline-flex items-center justify-center space-x-2 px-5 py-3.5 rounded-2xl bg-amber-400 hover:bg-amber-300 text-emerald-950 text-sm font-bold shadow-lg shadow-amber-400/20 active:scale-[0.98] transition-all"
        >
          <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2.5" d="M12 4v16m8-8H4"/>
          </svg>
          <span>Ajouter un Événement</span>
        </Link>
      </div>
    </div>
  );
}
