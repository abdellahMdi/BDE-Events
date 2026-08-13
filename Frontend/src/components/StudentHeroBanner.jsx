import { Link, useNavigate } from 'react-router-dom';
import { useAuth } from '../context/AuthContext';

export default function StudentHeroBanner({ eventsCount = 0 }) {
  const { user, logout } = useAuth();
  const navigate = useNavigate();

  const handleLogout = async () => {
    try {
      await logout();
    } catch (err) {
      console.error('Logout failed:', err);
    } finally {
      navigate('/login', { replace: true });
    }
  };

  return (
    <div className="bg-emerald-900 rounded-3xl p-6 sm:p-8 text-white shadow-xl flex flex-col md:flex-row justify-between items-start md:items-center gap-6 relative overflow-hidden">
      <div className="absolute -right-12 -bottom-12 w-64 h-64 bg-emerald-800/40 rounded-full blur-2xl"></div>
      <div className="absolute left-1/3 -top-12 w-48 h-48 bg-amber-500/10 rounded-full blur-xl"></div>

      <div className="space-y-2 z-10">
        <span className="inline-flex items-center px-3 py-1 bg-emerald-800/80 text-amber-300 text-xs font-semibold uppercase tracking-wider rounded-full border border-emerald-700/50">
          Tableau de bord
        </span>
        <h1 className="text-2xl sm:text-4xl font-extrabold tracking-tight">
          Bienvenue, {user?.name} {user?.lastName}
        </h1>
        <p className="text-emerald-200/80 text-sm max-w-xl">
          Découvrez les événements disponibles et gérez vos places en un seul clic.
        </p>
      </div>

      <div className="z-10 flex flex-wrap items-center gap-3 w-full md:w-auto justify-start md:justify-end">
        <div className="bg-emerald-800/80 backdrop-blur-md px-4 py-2.5 rounded-2xl border border-emerald-700 flex items-center gap-2.5">
          <div className="w-2.5 h-2.5 rounded-full bg-amber-400 animate-pulse"></div>
          <span className="text-xs font-medium text-emerald-100">
            <strong className="text-amber-300 text-sm font-bold">{eventsCount}</strong> Événements
          </span>
        </div>

        <Link
          to="/my-tickets"
          className="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl bg-amber-400 hover:bg-amber-300 text-emerald-950 text-xs font-bold transition-all shadow-md active:scale-[0.98]"
        >
          <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 002 2 2 2 0 010 4 2 2 0 00-2 2v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 00-2-2 2 2 0 010-4 2 2 0 002-2V7a2 2 0 00-2-2H5z"/>
          </svg>
          <span>Mes Billets</span>
        </Link>

        <button
          onClick={handleLogout}
          type="button"
          className="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl bg-emerald-800 hover:bg-rose-900/40 text-emerald-100 hover:text-rose-200 border border-emerald-700 hover:border-rose-500/40 text-xs font-semibold transition-all"
        >
          <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
          </svg>
          <span>Déconnexion</span>
        </button>
      </div>
    </div>
  );
}