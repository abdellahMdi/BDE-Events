<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard — Campus Events</title>
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
                <span class="px-2.5 py-0.5 bg-amber-100 text-amber-800 text-[10px] font-bold uppercase tracking-wider rounded-md border border-amber-200">
                    Admin Portal
                </span>
            </div>

            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="inline-flex items-center space-x-2 px-3.5 py-2 rounded-xl bg-stone-100 hover:bg-rose-50 text-stone-600 hover:text-rose-600 border border-stone-200 hover:border-rose-200 text-xs font-semibold transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    <span>Déconnexion</span>
                </button>
            </form>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">

        <div class="bg-emerald-900 rounded-3xl p-6 sm:p-10 text-white shadow-xl flex flex-col md:flex-row justify-between items-start md:items-center gap-6 relative overflow-hidden">
            <div class="absolute -right-12 -bottom-12 w-64 h-64 bg-emerald-800/40 rounded-full blur-2xl"></div>
            <div class="absolute left-1/3 -top-12 w-48 h-48 bg-amber-500/10 rounded-full blur-xl"></div>

            <div class="space-y-2 z-10 max-w-xl">
                <div class="inline-flex items-center space-x-2 px-3 py-1 bg-emerald-800/80 text-amber-300 text-xs font-semibold uppercase tracking-wider rounded-full border border-emerald-700/50 mb-1">
                    <span>Espasce Administration</span>
                </div>
                <h1 class="text-2xl sm:text-4xl font-extrabold tracking-tight">
                    Welcome Admin, {{ Auth::user()->name }}
                </h1>
                <p class="text-emerald-200/80 text-sm leading-relaxed">
                    Gérez vos événements, suivez les réservations et contrôlez la plateforme en toute simplicité.
                </p>
            </div>

            <div class="z-10 w-full md:w-auto">
                <a href="{{ route('addEventPage') }}" class="w-full md:w-auto inline-flex items-center justify-center space-x-2 px-5 py-3.5 rounded-2xl bg-amber-400 hover:bg-amber-300 text-emerald-950 text-sm font-bold shadow-lg shadow-amber-400/20 active:scale-[0.98] transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Ajouter un Événement</span>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            
            <div class="bg-white p-6 rounded-3xl border border-stone-200 shadow-sm flex items-center justify-between hover:border-emerald-200 transition-all">
                <div class="space-y-1">
                    <p class="text-xs font-bold text-stone-400 uppercase tracking-wider">Total Événements</p>
                    <h3 class="text-3xl font-black text-stone-900">{{ $totalEvents ?? 0 }}</h3>
                </div>
                <div class="w-12 h-12 bg-emerald-50 text-emerald-800 rounded-2xl flex items-center justify-center border border-emerald-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>

            <div class="bg-white p-6 rounded-3xl border border-stone-200 shadow-sm flex items-center justify-between hover:border-emerald-200 transition-all">
                <div class="space-y-1">
                    <p class="text-xs font-bold text-stone-400 uppercase tracking-wider">Total Réservations</p>
                    <h3 class="text-3xl font-black text-stone-900">{{ $totalReservations ?? 0 }}</h3>
                </div>
                <div class="w-12 h-12 bg-amber-50 text-amber-700 rounded-2xl flex items-center justify-center border border-amber-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 002 2 2 2 0 010 4 2 2 0 00-2 2v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 00-2-2 2 2 0 010-4 2 2 0 002-2V7a2 2 0 00-2-2H5z" />
                    </svg>
                </div>
            </div>

            <div class="bg-white p-6 rounded-3xl border border-stone-200 shadow-sm flex items-center justify-between sm:col-span-2 lg:col-span-1 hover:border-emerald-200 transition-all">
                <div class="space-y-1">
                    <p class="text-xs font-bold text-stone-400 uppercase tracking-wider">Statut du Système</p>
                    <div class="flex items-center space-x-2 pt-1">
                        <span class="w-3 h-3 bg-emerald-500 rounded-full animate-ping"></span>
                        <span class="text-base font-bold text-stone-800">Opérationnel</span>
                    </div>
                </div>
                <div class="w-12 h-12 bg-stone-100 text-stone-600 rounded-2xl flex items-center justify-center border border-stone-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>

        </div>

        <div class="bg-white rounded-3xl border border-stone-200 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-stone-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <h2 class="text-lg font-bold text-stone-900">Gestion des Événements</h2>
                    <p class="text-xs text-stone-500">Liste globale de tous les événements créés sur la plateforme.</p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-stone-600">
                    <thead class="bg-stone-50 text-[11px] text-stone-400 uppercase font-bold tracking-wider">
                        <tr>
                            <th class="px-6 py-4">Titre</th>
                            <th class="px-6 py-4">Lieu</th>
                            <th class="px-6 py-4">Date & Heure</th>
                            <th class="px-6 py-4">Prix</th>
                            <th class="px-6 py-4">Places</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-100">
                        @forelse ($events as $event)
                            <tr class="hover:bg-stone-50/80 transition-colors">
                                <td class="px-6 py-4 font-bold text-stone-900">{{ $event->title }}</td>
                                <td class="px-6 py-4 text-stone-600">{{ $event->place }}</td>
                                <td class="px-6 py-4 text-stone-600 font-medium">
                                    {{ \Carbon\Carbon::parse($event->date)->format('d M, Y') }} <span class="text-stone-400 text-xs">à</span> {{ $event->houre }}
                                </td>
                                <td class="px-6 py-4 font-extrabold text-emerald-800">
                                    {{ $event->price }} DH
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full bg-emerald-50 text-emerald-800 border border-emerald-200 text-xs font-semibold">
                                        {{ $event->places_limite }} places
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end space-x-2">
                                        <a href="{{ route('editEventPage', $event->id) }}" class="inline-flex items-center space-x-1 px-3 py-1.5 text-xs font-semibold text-stone-700 bg-stone-100 hover:bg-emerald-50 hover:text-emerald-800 rounded-xl transition-all border border-stone-200 hover:border-emerald-200">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            <span>Modifier</span>
                                        </a>

                                        <form method="POST" action="{{ route('deleteEvent', $event->id) }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet événement ?')" class="inline-flex items-center space-x-1 px-3 py-1.5 text-xs font-semibold text-rose-600 bg-rose-50 hover:bg-rose-100 rounded-xl transition-all border border-rose-200">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                <span>Supprimer</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-stone-400 text-sm">
                                    <svg class="w-10 h-10 mx-auto mb-3 text-stone-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                    </svg>
                                    <p class="font-medium text-stone-500">Aucun événement n'a été trouvé.</p>
                                    <p class="text-xs text-stone-400 mt-1">Commencez par ajouter votre premier événement ci-dessus.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
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