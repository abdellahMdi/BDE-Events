<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($event) ? 'Modifier l\'événement' : 'Créer un événement' }} — Campus Events</title>
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

            <a href="{{ route('adminDashboard') }}" class="inline-flex items-center space-x-2 px-3.5 py-2 rounded-xl bg-stone-100 hover:bg-stone-200 text-stone-700 text-xs font-semibold transition-all border border-stone-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                <span>Retour</span>
            </a>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">

        <div class="bg-emerald-900 rounded-3xl p-6 sm:p-8 text-white shadow-xl flex justify-between items-center relative overflow-hidden">
        
            <div class="absolute -right-12 -bottom-12 w-64 h-64 bg-emerald-800/40 rounded-full blur-2xl"></div>
            <div class="absolute left-1/3 -top-12 w-48 h-48 bg-amber-500/10 rounded-full blur-xl"></div>

            <div class="space-y-1 z-10">
                <span class="inline-flex items-center px-3 py-1 bg-emerald-800/80 text-amber-300 text-xs font-semibold uppercase tracking-wider rounded-full border border-emerald-700/50 mb-2">
                    Événements
                </span>
                <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">
                    {{ isset($event) ? 'Modifier l\'événement' : 'Créer un événement' }}
                </h1>
                <p class="text-emerald-200/80 text-sm">Remplissez les détails ci-dessous pour publier votre événement.</p>
            </div>

            <a href="{{ route('adminDashboard') }}" class="z-10 hidden sm:inline-flex items-center space-x-2 px-4 py-2.5 rounded-xl bg-emerald-800 hover:bg-emerald-700 text-emerald-100 text-xs font-semibold transition-all border border-emerald-700">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                <span>Retour</span>
            </a>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-stone-200 p-6 sm:p-8">
            <form action="{{isset($event) && $event->id ? route('updateEvent', $event->id) : route('saveEvent') }}" method="POST" class="space-y-6">
                @csrf
                @if(isset($event))
                    @method('PUT')
                @endif

                <div>
                    <label for="title" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-2">Titre de l'événement</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $event->title ?? '') }}" placeholder="ex: Laravel Day" required
                        class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 text-sm transition-all outline-none bg-stone-50/30">
                    @error('title') <span class="text-xs text-rose-500 mt-1 block font-medium">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="place" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-2">Lieu (Place)</label>
                    <input type="text" name="place" id="place" value="{{ old('place', $event->place ?? '') }}" placeholder="ex: Beni Mellal" required
                        class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 text-sm transition-all outline-none bg-stone-50/30">
                    @error('place') <span class="text-xs text-rose-500 mt-1 block font-medium">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="date" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-2">Date</label>
                        <input type="date" name="date" id="date" value="{{ old('date', $event->date ?? '') }}" required
                            class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 text-sm transition-all outline-none bg-stone-50/30">
                        @error('date') <span class="text-xs text-rose-500 mt-1 block font-medium">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="houre" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-2">Heure</label>
                        <input type="time" name="houre" id="houre" value="{{ old('houre', $event->houre ?? '') }}" required
                            class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 text-sm transition-all outline-none bg-stone-50/30">
                        @error('houre') <span class="text-xs text-rose-500 mt-1 block font-medium">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="price" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-2">Prix (DH)</label>
                        <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $event->price ?? '') }}" placeholder="0 pour Gratuit"
                            class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 text-sm transition-all outline-none bg-stone-50/30">
                        @error('price') <span class="text-xs text-rose-500 mt-1 block font-medium">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="places_limite" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-2">Places Limitées</label>
                        <input type="number" name="places_limite" id="places_limite" value="{{ old('places_limite', $event->places_limite ?? '') }}" placeholder="ex: 100" required
                            class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 text-sm transition-all outline-none bg-stone-50/30">
                        @error('places_limite') <span class="text-xs text-rose-500 mt-1 block font-medium">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div>
                    <label for="description" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-2">Description</label>
                    <textarea name="description" id="description" rows="4" placeholder="Description de l'événement..." required
                        class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 text-sm transition-all outline-none resize-none bg-stone-50/30">{{ old('description', $event->description ?? '') }}</textarea>
                    @error('description') <span class="text-xs text-rose-500 mt-1 block font-medium">{{ $message }}</span> @enderror
                </div>

                <div class="pt-4 flex items-center justify-end space-x-3">
                    <a href="{{ route('adminDashboard') }}" class="px-6 py-3 rounded-xl border border-stone-200 text-stone-600 font-semibold text-xs hover:bg-stone-50 transition-all">
                        Annuler
                    </a>
                    <button type="submit" class="px-6 py-3 rounded-2xl bg-amber-400 hover:bg-amber-300 text-emerald-950 font-bold text-xs shadow-md active:scale-[0.98] transition-all">
                        {{ isset($event) ? 'Mettre à jour' : 'Enregistrer' }}
                    </button>
                </div>
            </form>
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