import { useState } from 'react';
import { useAuth } from '../context/AuthContext';
import { useNavigate } from 'react-router-dom';

export default function AdminNavbar() {
  const { logout } = useAuth();
  const navigate = useNavigate();
  const [isLoggingOut, setIsLoggingOut] = useState(false);

  const handleLogout = async () => {
    setIsLoggingOut(true);
    try {
      await logout();
    } catch (err) {
      console.error('Logout API call failed:', err);
    } finally {
      // Always redirect to login and replace history so back button won't return to admin
      navigate('/login', { replace: true });
    }
  };

  return (
    <header className="bg-white border-b border-stone-200 sticky top-0 z-30">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
        <div className="flex items-center space-x-3">
          <div className="w-9 h-9 bg-amber-400 text-emerald-950 rounded-xl flex items-center justify-center font-black text-lg shadow-sm">
            E
          </div>
          <span className="font-bold text-base tracking-wide text-stone-900">Campus Events</span>
          <span className="px-2.5 py-0.5 bg-amber-100 text-amber-800 text-[10px] font-bold uppercase tracking-wider rounded-md border border-amber-200">
            Admin Portal
          </span>
        </div>

        <button
          onClick={handleLogout}
          disabled={isLoggingOut}
          type="button"
          className="inline-flex items-center space-x-2 px-3.5 py-2 rounded-xl bg-stone-100 hover:bg-rose-50 text-stone-600 hover:text-rose-600 border border-stone-200 hover:border-rose-200 text-xs font-semibold transition-all disabled:opacity-50"
        >
          <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
          </svg>
          <span>{isLoggingOut ? 'Déconnexion...' : 'Déconnexion'}</span>
        </button>
      </div>
    </header>
  );
}