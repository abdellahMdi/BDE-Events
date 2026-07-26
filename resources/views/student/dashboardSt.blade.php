<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord — Campus Events</title>
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

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">

        <div class="bg-emerald-900 rounded-3xl p-6 sm:p-8 text-white shadow-xl flex flex-col md:flex-row justify-between items-start md:items-center gap-6 relative overflow-hidden">
            <div class="absolute -right-12 -bottom-12 w-64 h-64 bg-emerald-800/40 rounded-full blur-2xl"></div>
            <div class="absolute left-1/3 -top-12 w-48 h-48 bg-amber-500/10 rounded-full blur-xl"></div>

            <div class="space-y-2 z-10">
                <span class="inline-flex items-center px-3 py-1 bg-emerald-800/80 text-amber-300 text-xs font-semibold uppercase tracking-wider rounded-full border border-emerald-700/50">
                    Tableau de bord
                </span>
                <h1 class="text-2xl sm:text-4xl font-extrabold tracking-tight">
                    Bienvenue, {{ Auth::user()->name }} {{ Auth::user()->lastName }}
                </h1>
                <p class="text-emerald-200/80 text-sm max-w-xl">
                    Découvrez les événements disponibles et gérez vos places en un seul clic.
                </p>
            </div>

            <div class="z-10 flex flex-wrap items-center gap-3 w-full md:w-auto justify-start md:justify-end">
                <div class="bg-emerald-800/80 backdrop-blur-md px-4 py-2.5 rounded-2xl border border-emerald-700 flex items-center gap-2.5">
                    <div class="w-2.5 h-2.5 rounded-full bg-amber-400 animate-pulse"></div>
                    <span class="text-xs font-medium text-emerald-100">
                        <strong class="text-amber-300 text-sm font-bold">{{ $events->count() }}</strong> Événements
                    </span>
                </div>

                <a href="{{ route('myTickets',  ['id' => auth()->id()]) }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl bg-amber-400 hover:bg-amber-300 text-emerald-950 text-xs font-bold transition-all shadow-md active:scale-[0.98]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 002 2 2 2 0 010 4 2 2 0 00-2 2v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 00-2-2 2 2 0 010-4 2 2 0 002-2V7a2 2 0 00-2-2H5z"/>
                    </svg>
                    <span>Mes Billets</span>
                </a>

                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl bg-emerald-800 hover:bg-rose-900/40 text-emerald-100 hover:text-rose-200 border border-emerald-700 hover:border-rose-500/40 text-xs font-semibold transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        <span>Déconnexion</span>
                    </button>
                </form>
            </div>
        </div>

        <div class="flex items-center justify-between pt-2">
            <div>
                <h2 class="text-xl font-bold text-stone-900">Événements à venir</h2>
                <p class="text-xs text-stone-500">Cliquez sur un événement pour consulter ses informations détaillées.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 items-stretch">
            @forelse ($events as $event)
                @php
                    $isReserved = \App\Models\Reservation::where('user_id', auth()->id())->where('event_id', $event->id)->exists();
                @endphp

                <div class="bg-white rounded-3xl border border-stone-200 shadow-sm hover:shadow-md transition-all overflow-hidden flex flex-col justify-between group relative">
                    
                    <a href="{{ route('showEvent', $event->id) }}" class="p-6 space-y-4 block flex-1">
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="px-2.5 py-1 bg-amber-100 text-amber-900 border border-amber-200 rounded-lg text-xs font-extrabold">
                                    {{ $event->price ? $event->price . ' DH' : 'Gratuit' }}
                                </span>
                                @if($isReserved)
                                    <span class="px-2 py-0.5 bg-emerald-100 text-emerald-800 text-[11px] font-bold rounded-md">
                                        Réservé ✓
                                    </span>
                                @else
                                    <span class="text-[11px] font-semibold text-stone-500">
                                        {{ $event->places_limite }} places
                                    </span>
                                @endif
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-stone-900 group-hover:text-emerald-800 transition-colors flex items-center justify-between">
                                    <span>{{ $event->title }}</span>
                                    <svg class="w-4 h-4 text-stone-400 group-hover:text-emerald-800 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </h3>
                                <p class="text-xs text-stone-500 mt-1 line-clamp-2">{{ $event->description }}</p>
                            </div>
                        </div>

                        <div class="pt-3 border-t border-stone-100">
                            <div class="grid grid-cols-2 gap-2 text-xs font-semibold text-stone-600">
                                <div class="flex items-center space-x-1.5">
                                    <svg class="w-3.5 h-3.5 text-emerald-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    <span>{{ $event->date }}</span>
                                </div>
                                <div class="flex items-center space-x-1.5">
                                    <svg class="w-3.5 h-3.5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                                    <span class="truncate">{{ $event->place }}</span>
                                </div>
                            </div>
                        </div>
                    </a>

                    <div class="px-6 pb-6 pt-0 z-10">
                        @if($isReserved)
                            <form method="POST" action="{{ route('cancelReservation', $event->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full py-2.5 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-600 border border-rose-200 text-xs font-bold transition-all active:scale-[0.98] flex items-center justify-center space-x-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                    <span>Annuler la réservation</span>
                                </button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('reserveEvent', $event->id) }}">
                                @csrf
                                <button type="submit" class="w-full py-2.5 rounded-xl bg-amber-400 hover:bg-amber-300 text-emerald-950 text-xs font-bold shadow-sm active:scale-[0.98] transition-all">
                                    Réserver ma place
                                </button>
                            </form>
                        @endif
                    </div>

                </div>
            @empty
                <div class="col-span-full py-16 text-center bg-white rounded-3xl border border-stone-200 shadow-sm space-y-3">
                    <div class="w-14 h-14 mx-auto bg-emerald-50 text-emerald-800 rounded-2xl flex items-center justify-center border border-emerald-100">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-stone-900">Aucun événement disponible</h3>
                        <p class="text-xs text-stone-500 mt-1">Revenez plus tard pour voir les nouveaux événements organisés.</p>
                    </div>
                </div>
            @endforelse
        </div>

    </main>

</body>
</html>