<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $event->title }} — Campus Events</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="bg-stone-100 text-stone-800 min-h-screen">
    <header class="bg-white border-b border-stone-200 sticky top-0 z-30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-9 h-9 bg-amber-400 text-emerald-950 rounded-xl flex items-center justify-center font-black text-lg shadow-sm">
                    E
                </div>
                <span class="font-bold text-base tracking-wide text-stone-900">Campus Events</span>
                <span class="px-2.5 py-0.5 bg-emerald-100 text-emerald-800 text-[10px] font-bold uppercase tracking-wider rounded-md border border-emerald-200">
                    Espace Étudiant
                </span>
            </div>
            <div class="flex items-center space-x-3">
                <div class="hidden sm:flex items-center space-x-2 px-3 py-1.5 bg-stone-100 rounded-xl border border-stone-200">
                    <div class="w-6 h-6 rounded-lg bg-emerald-800 text-amber-300 font-bold text-xs flex items-center justify-center">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <span class="text-xs font-semibold text-stone-700">
                        {{ Auth::user()->name }} {{ Auth::user()->lastName }}
                    </span>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-6">

        <div>
            <a href="{{ route('dashboardStudent') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white border border-stone-200 text-stone-700 text-xs font-bold hover:bg-stone-50 transition-all shadow-sm">
                <svg class="w-4 h-4 text-stone-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                <span>Retour au tableau de bord</span>
            </a>
        </div>

        @php
            $isReserved = \App\Models\Reservation::where('user_id', auth()->id())->where('event_id', $event->id)->exists();
        @endphp

        <div class="bg-emerald-900 rounded-3xl p-6 sm:p-10 text-white shadow-xl relative overflow-hidden space-y-6">
            <div class="absolute -right-12 -bottom-12 w-64 h-64 bg-emerald-800/40 rounded-full blur-2xl"></div>
            <div class="absolute left-1/3 -top-12 w-48 h-48 bg-amber-500/10 rounded-full blur-xl"></div>

            <div class="flex flex-wrap items-center justify-between gap-3 z-10 relative">
                <span class="inline-flex items-center px-3.5 py-1.5 bg-amber-400 text-emerald-950 text-xs font-extrabold uppercase tracking-wider rounded-xl shadow-sm">
                    {{ $event->price ? $event->price . ' DH' : 'Gratuit' }}
                </span>

                @if($isReserved)
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-800/90 text-amber-300 text-xs font-bold rounded-xl border border-emerald-700">
                        <svg class="w-4 h-4 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Réservation confirmée
                    </span>
                @else
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-800/60 text-emerald-100 text-xs font-semibold rounded-xl border border-emerald-700/50">
                        {{ $event->places_limite }} places disponibles
                    </span>
                @endif
            </div>

            <div class="space-y-3 z-10 relative">
                <h1 class="text-2xl sm:text-4xl font-extrabold tracking-tight">
                    {{ $event->title }}
                </h1>
                
                @if($event->category)
                    <p class="text-xs font-semibold text-emerald-300 uppercase tracking-widest">
                        Catégorie : {{ $event->category->name ?? $event->category }}
                    </p>
                @endif
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-stone-200 shadow-sm p-6 sm:p-8 space-y-8">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 p-4 bg-stone-50 rounded-2xl border border-stone-100">
                
                <div class="flex items-start space-x-3">
                    <div class="p-2.5 bg-emerald-100 text-emerald-800 rounded-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <span class="block text-[11px] font-semibold text-stone-400 uppercase tracking-wider">Date & Heure</span>
                        <span class="text-xs font-bold text-stone-800">{{ $event->date }}</span>
                    </div>
                </div>

                <div class="flex items-start space-x-3">
                    <div class="p-2.5 bg-amber-100 text-amber-800 rounded-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        </svg>
                    </div>
                    <div>
                        <span class="block text-[11px] font-semibold text-stone-400 uppercase tracking-wider">Lieu</span>
                        <span class="text-xs font-bold text-stone-800">{{ $event->place }}</span>
                    </div>
                </div>

                <div class="flex items-start space-x-3">
                    <div class="p-2.5 bg-stone-200 text-stone-700 rounded-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <div>
                        <span class="block text-[11px] font-semibold text-stone-400 uppercase tracking-wider">Capacité</span>
                        <span class="text-xs font-bold text-stone-800">{{ $event->places_limite }} places totales</span>
                    </div>
                </div>

            </div>

            <div class="space-y-3">
                <h3 class="text-base font-bold text-stone-900 border-b border-stone-100 pb-2">
                    À propos de cet événement
                </h3>
                <p class="text-xs sm:text-sm text-stone-600 leading-relaxed whitespace-pre-line">
                    {{ $event->description }}
                </p>
            </div>

            <div class="pt-6 border-t border-stone-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="text-xs text-stone-500">
                    @if($isReserved)
                        <span class="text-emerald-700 font-semibold">Vous êtes déjà inscrit à cet événement.</span>
                    @else
                        <span>Cliquez sur le bouton ci-contre pour valider votre inscription.</span>
                    @endif
                </div>

                <div class="w-full sm:w-auto min-w-[200px]">
                    @if($isReserved)
                        <form method="POST" action="{{ route('cancelReservation', $event->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full py-3 px-6 rounded-2xl bg-rose-50 hover:bg-rose-100 text-rose-600 border border-rose-200 text-xs font-bold transition-all active:scale-[0.98] flex items-center justify-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                <span>Annuler la réservation</span>
                            </button>
                        </form>
                    @else
                        <form method="POST" action="{{ route('reserveEvent', $event->id) }}">
                            @csrf
                            <button type="submit" class="w-full py-3 px-6 rounded-2xl bg-amber-400 hover:bg-amber-300 text-emerald-950 text-xs font-bold shadow-md active:scale-[0.98] transition-all flex items-center justify-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 002 2 2 2 0 010 4 2 2 0 00-2 2v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 00-2-2 2 2 0 010-4 2 2 0 002-2V7a2 2 0 00-2-2H5z"/>
                                </svg>
                                <span>Réserver ma place</span>
                            </button>
                        </form>
                    @endif
                </div>
            </div>

        </div>

    </main>
    <script>
        window.addEventListener('pageshow', function (event) {
            // If page was loaded from back/forward cache, force reload
            if (event.persisted || (performance && performance.getEntriesByType("navigation")[0].type === "back_forward")) {
                window.location.reload();
            }
        });
    </script>
</body>
</html>