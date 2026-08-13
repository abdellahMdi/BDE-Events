import { useAuth } from '../context/AuthContext';

export default function StudentHeader() {
  const { user } = useAuth();
  const initial = user?.name ? user.name.charAt(0).toUpperCase() : 'U';

  return (
    <header className="bg-white border-b border-stone-200 sticky top-0 z-30">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
        <div className="flex items-center space-x-3">
          <div className="w-9 h-9 bg-amber-400 text-emerald-950 rounded-xl flex items-center justify-center font-black text-lg shadow-sm">
            E
          </div>
          <span className="font-bold text-base tracking-wide text-stone-900">Campus Events</span>
          <span className="px-2.5 py-0.5 bg-emerald-100 text-emerald-800 text-[10px] font-bold uppercase tracking-wider rounded-md border border-emerald-200">
            Espace Étudiant
          </span>
        </div>

        <div className="flex items-center space-x-3">
          <div className="hidden sm:flex items-center space-x-2 px-3 py-1.5 bg-stone-100 rounded-xl border border-stone-200">
            <div className="w-6 h-6 rounded-lg bg-emerald-800 text-amber-300 font-bold text-xs flex items-center justify-center">
              {initial}
            </div>
            <span className="text-xs font-semibold text-stone-700">
              {user?.name} {user?.lastName}
            </span>
          </div>
        </div>
      </div>
    </header>
  );
}