<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Tickets — Campus Events</title>
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

            <a href="{{ route('dashboardStudent') }}" class="inline-flex items-center space-x-2 px-3.5 py-2 rounded-xl bg-stone-100 hover:bg-stone-200 text-stone-700 text-xs font-semibold transition-all border border-stone-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                <span>Retour</span>
            </a>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">

        <div class="bg-emerald-900 rounded-3xl p-6 sm:p-10 text-white shadow-xl flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6 relative overflow-hidden">
            <div class="absolute -right-12 -bottom-12 w-64 h-64 bg-emerald-800/40 rounded-full blur-2xl"></div>
            <div class="absolute left-1/3 -top-12 w-48 h-48 bg-amber-500/10 rounded-full blur-xl"></div>

            <div class="space-y-1 z-10">
                <span class="inline-flex items-center px-3 py-1 bg-emerald-800/80 text-amber-300 text-xs font-semibold uppercase tracking-wider rounded-full border border-emerald-700/50 mb-2">
                    Réservations
                </span>
                <h1 class="text-2xl sm:text-4xl font-extrabold tracking-tight">
                    Mes Tickets
                </h1>
                <p class="text-emerald-200/80 text-sm">Consultez et présentez vos billets d'accès aux événements.</p>
            </div>

            <div class="z-10 px-5 py-3 rounded-2xl bg-emerald-800/90 border border-emerald-700 text-center flex sm:flex-col items-center justify-between w-full sm:w-auto">
                <span class="text-xs font-semibold uppercase tracking-wider text-emerald-200">Total Billets</span>
                <span class="text-2xl sm:text-3xl font-black text-amber-300 ml-2 sm:ml-0">{{ $tickets->count() }}</span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($tickets as $ticket)
                <div class="bg-white rounded-3xl border border-stone-200 shadow-sm hover:shadow-md transition-all overflow-hidden flex flex-col justify-between relative group">
                    
                    <div class="h-2 bg-gradient-to-r from-emerald-800 via-amber-400 to-emerald-800"></div>

                    <div class="p-6 space-y-5">
                        <div class="flex items-center justify-between border-b border-stone-100 pb-4">
                            <div>
                                <span class="text-[10px] font-bold uppercase tracking-widest text-stone-400 block">Pass Accès</span>
                                <h2 class="text-lg font-black text-stone-900">Ticket #{{ $ticket->id }}</h2>
                            </div>
                            <span class="px-2.5 py-1 bg-emerald-50 text-emerald-800 border border-emerald-200 rounded-lg text-xs font-bold uppercase">
                                Valide
                            </span>
                        </div>

                        <div class="space-y-3">
                            <div>
                                <span class="text-[11px] font-bold uppercase tracking-wider text-stone-400 block mb-0.5">Événement</span>
                                <p class="text-base font-bold text-stone-900 leading-snug">
                                    {{ $ticket->reservation->event->title }}
                                </p>
                            </div>

                            <div class="grid grid-cols-2 gap-4 pt-1">
                                <div>
                                    <span class="text-[11px] font-bold uppercase tracking-wider text-stone-400 block mb-0.5">Date</span>
                                    <div class="flex items-center text-xs font-semibold text-stone-700 space-x-1.5">
                                        <svg class="w-3.5 h-3.5 text-emerald-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span>{{ $ticket->reservation->event->date }}</span>
                                    </div>
                                </div>

                                <div>
                                    <span class="text-[11px] font-bold uppercase tracking-wider text-stone-400 block mb-0.5">Lieu</span>
                                    <div class="flex items-center text-xs font-semibold text-stone-700 space-x-1.5">
                                        <svg class="w-3.5 h-3.5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        <span class="truncate">{{ $ticket->reservation->event->place }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="relative flex items-center my-1">
                        <div class="w-4 h-8 bg-stone-100 rounded-r-full border-r border-t border-b border-stone-200"></div>
                        <div class="flex-1 border-b-2 border-dashed border-stone-200 mx-2"></div>
                        <div class="w-4 h-8 bg-stone-100 rounded-l-full border-l border-t border-b border-stone-200"></div>
                    </div>

                    <div class="p-6 bg-stone-50/80 pt-2 space-y-2 text-center">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-stone-400 block">Code du Ticket</span>
                        
                        <div class="py-2 px-3 bg-white border border-stone-200 rounded-xl inline-block shadow-inner w-full">
                            <span class="font-mono text-xs font-extrabold tracking-widest text-emerald-950">
                                {{ $ticket->ticket_code }}
                            </span>
                        </div>

                        <div class="pt-2 flex justify-center items-center space-x-1 opacity-60">
                            <div class="w-1 h-6 bg-stone-800"></div>
                            <div class="w-0.5 h-6 bg-stone-800"></div>
                            <div class="w-1.5 h-6 bg-stone-800"></div>
                            <div class="w-0.5 h-6 bg-stone-800"></div>
                            <div class="w-1 h-6 bg-stone-800"></div>
                            <div class="w-2 h-6 bg-stone-800"></div>
                            <div class="w-0.5 h-6 bg-stone-800"></div>
                            <div class="w-1.5 h-6 bg-stone-800"></div>
                            <div class="w-1 h-6 bg-stone-800"></div>
                            <div class="w-0.5 h-6 bg-stone-800"></div>
                            <div class="w-2 h-6 bg-stone-800"></div>
                        </div>
                    </div>

                </div>
            @empty
                <div class="col-span-full bg-white rounded-3xl border border-stone-200 p-12 text-center shadow-sm space-y-4">
                    <div class="w-16 h-16 bg-emerald-50 text-emerald-800 rounded-2xl flex items-center justify-center mx-auto border border-emerald-100">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 002 2 2 2 0 010 4 2 2 0 00-2 2v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 00-2-2 2 2 0 010-4 2 2 0 002-2V7a2 2 0 00-2-2H5z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-stone-900">Aucun ticket trouvé</h3>
                        <p class="text-xs text-stone-500 mt-1">Vous n'avez pas encore réservé de places pour un événement.</p>
                    </div>
                </div>
            @endforelse
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