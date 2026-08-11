export default function AuthSideBanner() {
  return (
    <div className="hidden lg:flex lg:col-span-5 bg-emerald-900 text-stone-100 p-8 sm:p-12 flex-col justify-between relative overflow-hidden">
      {/* Glow Effects */}
      <div className="absolute -right-16 -bottom-16 w-64 h-64 bg-emerald-800/50 rounded-full blur-2xl"></div>
      <div className="absolute -left-12 -top-12 w-48 h-48 bg-amber-500/20 rounded-full blur-xl"></div>

      {/* Brand Header */}
      <div className="relative z-10 flex items-center space-x-3">
        <div className="w-10 h-10 bg-amber-400 text-emerald-950 rounded-2xl flex items-center justify-center font-black text-xl shadow-md">
          E
        </div>
        <span className="font-bold text-lg tracking-wide text-white">Campus Events</span>
      </div>

      {/* Main Copy */}
      <div className="relative z-10 my-12">
        <span className="px-3 py-1 bg-emerald-800/80 text-amber-300 text-xs font-semibold uppercase tracking-wider rounded-full border border-emerald-700/50 inline-block mb-4">
          Student & Admin Access
        </span>
        <h1 className="text-3xl sm:text-4xl font-extrabold text-white leading-tight mb-3">
          Discover & Manage Events seamlessly.
        </h1>
        <p className="text-emerald-200/80 text-sm leading-relaxed">
          Reserve tickets for upcoming campus events or organize your own directly from the dashboard.
        </p>
      </div>

      {/* Quick Tip Box */}
      <div className="relative z-10 bg-emerald-950/60 backdrop-blur-md p-4 rounded-2xl border border-emerald-800/40 text-xs text-emerald-100/90">
        ⚡ <strong className="text-white">Quick Tip:</strong> Make sure to log in with your official account email.
      </div>
    </div>
  );
}
