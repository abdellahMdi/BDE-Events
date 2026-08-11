import { Link } from 'react-router-dom';

export default function PageBanner({ title, subtitle, badgeText = "Événements" }) {
  return (
    <div class="bg-emerald-900 rounded-3xl p-6 sm:p-8 text-white shadow-xl flex justify-between items-center relative overflow-hidden">
      <div class="absolute -right-12 -bottom-12 w-64 h-64 bg-emerald-800/40 rounded-full blur-2xl"></div>
      <div class="absolute left-1/3 -top-12 w-48 h-48 bg-amber-500/10 rounded-full blur-xl"></div>

      <div class="space-y-1 z-10">
        <span class="inline-flex items-center px-3 py-1 bg-emerald-800/80 text-amber-300 text-xs font-semibold uppercase tracking-wider rounded-full border border-emerald-700/50 mb-2">
          {badgeText}
        </span>
        <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">{title}</h1>
        <p class="text-emerald-200/80 text-sm">{subtitle}</p>
      </div>

      <Link
        to="/admin/dashboard"
        class="z-10 hidden sm:inline-flex items-center space-x-2 px-4 py-2.5 rounded-xl bg-emerald-800 hover:bg-emerald-700 text-emerald-100 text-xs font-semibold transition-all border border-emerald-700"
      >
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        <span>Retour</span>
      </Link>
    </div>
  );
}
