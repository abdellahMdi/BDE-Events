<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Portal — Sign In</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="bg-stone-100 text-stone-800 min-h-screen flex items-center justify-center p-4 sm:p-6 lg:p-8">

    <div class="w-full max-w-5xl bg-white rounded-3xl shadow-xl overflow-hidden border border-stone-200 grid grid-cols-1 lg:grid-cols-12 min-h-[620px]">
        
        <div class="hidden lg:flex lg:col-span-5 bg-emerald-900 text-stone-100 p-8 sm:p-12 flex-col justify-between relative overflow-hidden">

            <div class="absolute -right-16 -bottom-16 w-64 h-64 bg-emerald-800/50 rounded-full blur-2xl"></div>
            <div class="absolute -left-12 -top-12 w-48 h-48 bg-amber-500/20 rounded-full blur-xl"></div>

            <div class="relative z-10 flex items-center space-x-3">
                <div class="w-10 h-10 bg-amber-400 text-emerald-950 rounded-2xl flex items-center justify-center font-black text-xl shadow-md">
                    E
                </div>
                <span class="font-bold text-lg tracking-wide text-white">Campus Events</span>
            </div>

            <div class="relative z-10 my-12">
                <span class="px-3 py-1 bg-emerald-800/80 text-amber-300 text-xs font-semibold uppercase tracking-wider rounded-full border border-emerald-700/50 inline-block mb-4">
                    Student & Admin Access
                </span>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-white leading-tight mb-3">
                    Discover & Manage Events seamlessly.
                </h1>
                <p class="text-emerald-200/80 text-sm leading-relaxed">
                    Reserve tickets for upcoming campus events or organize your own directly from the dashboard.
                </p>
            </div>

            <div class="relative z-10 bg-emerald-950/60 backdrop-blur-md p-4 rounded-2xl border border-emerald-800/40 text-xs text-emerald-100/90">
                ⚡ <strong class="text-white">Quick Tip:</strong> Make sure to log in with your official account email.
            </div>
        </div>

        <div class="col-span-1 lg:col-span-7 p-8 sm:p-12 lg:p-16 flex flex-col justify-center bg-white">
            
            <div class="max-w-md w-full mx-auto">
                <div class="mb-8">
                    <h2 class="text-2xl sm:text-3xl font-bold text-stone-900 tracking-tight mb-2">Sign in to your account</h2>
                    <p class="text-sm text-stone-500">Welcome back! Please enter your details below.</p>
                </div>

                <form class="space-y-6" method="POST" action="{{ route('loginLogic') }}">
                    @csrf
                    <div>
                        <label for="email" class="block text-xs font-semibold text-stone-700 uppercase tracking-wider mb-2">
                            Email Address
                        </label>
                        <div class="relative flex items-center">
                            <span class="absolute left-4 text-stone-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                </svg>
                            </span>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="e.g. user@school.edu"
                                class="w-full pl-12 pr-4 py-3.5 bg-stone-50 border border-stone-200 rounded-2xl text-stone-900 text-sm placeholder-stone-400 focus:outline-none focus:bg-white focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10 transition-all duration-200">
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-xs font-semibold text-stone-700 uppercase tracking-wider mb-2">
                            Password
                        </label>
                        <div class="relative flex items-center">
                            <span class="absolute left-4 text-stone-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </span>
                            <input type="password" id="password" name="password" required placeholder="••••••••"
                                class="w-full pl-12 pr-12 py-3.5 bg-stone-50 border border-stone-200 rounded-2xl text-stone-900 text-sm placeholder-stone-400 focus:outline-none focus:bg-white focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10 transition-all duration-200">
                            
                            <button type="button" id="togglePassword" class="absolute right-4 text-stone-400 hover:text-stone-600 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    @error('email')
                        <div class="p-3.5 bg-rose-50 border border-rose-200 rounded-2xl flex items-center space-x-3 text-rose-700 text-xs font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror

                    <button type="submit"
                        class="w-full py-4 px-6 bg-emerald-900 hover:bg-emerald-950 text-white text-sm font-bold rounded-2xl shadow-lg shadow-emerald-900/20 active:scale-[0.98] transition-all duration-200 flex items-center justify-center space-x-2">
                        <span>Continue to Account</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>

    </div>
    
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function () {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
        });
        window.addEventListener('pageshow', function (event) {
            // If page was loaded from back/forward cache, force reload
            if (event.persisted || (performance && performance.getEntriesByType("navigation")[0].type === "back_forward")) {
                window.location.reload();
            }
        });
    </script>

</body>
</html>