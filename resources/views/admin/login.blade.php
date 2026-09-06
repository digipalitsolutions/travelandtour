<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login | {{ config('app.name', 'Aethereal Luxury Travel') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
</head>
<body class="bg-[#f8f9ff] text-[#0d1c2e] antialiased">
    <main class="mx-auto grid min-h-screen max-w-7xl items-center gap-10 px-4 py-12 sm:px-6 lg:grid-cols-[1fr_440px] lg:px-8">
        <section>
            <a href="{{ route('home') }}" class="mb-10 flex items-center gap-3">
                <img src="{{ asset('assets/images/abc_travel_agency_logo.png') }}" alt="Aethereal Luxury Travel logo" class="h-16 w-40 rounded-lg object-contain">
            </a>
            <p class="text-xs font-bold uppercase tracking-[0.22em] text-[#006b5f]">Admin portal</p>
            <h1 class="font-display mt-3 max-w-2xl text-4xl font-extrabold leading-tight text-[#0a2540] sm:text-5xl">Manage packages, bookings, clients, and travel operations.</h1>
            <p class="mt-5 max-w-2xl text-base leading-7 text-slate-600">Use this page as the dedicated admin entry point. Full authentication can be connected later with Laravel guards and password storage.</p>
        </section>

        <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_12px_24px_-18px_rgba(10,37,64,0.35)]">
            <h2 class="font-display text-2xl font-extrabold text-[#0a2540]">Admin Login</h2>
            @if ($errors->any())
                <div class="mt-5 rounded-xl border border-red-200 bg-red-50 p-4 text-sm font-semibold text-red-700">
                    Invalid admin email or password.
                </div>
            @endif

            <form class="mt-6 space-y-5" method="POST" action="{{ route('admin.authenticate') }}">
                @csrf
                <label class="block">
                    <span class="text-sm font-bold text-[#0a2540]">Email address</span>
                    <input name="email" type="email" value="{{ old('email') }}" placeholder="admin@example.com" class="mt-2 h-12 w-full rounded-xl border border-slate-200 px-4 text-sm outline-none focus:border-[#00a896] focus:ring-4 focus:ring-[#00a896]/15" required>
                </label>
                <label class="block">
                    <span class="text-sm font-bold text-[#0a2540]">Password</span>
                    <input name="password" type="password" placeholder="Enter password" class="mt-2 h-12 w-full rounded-xl border border-slate-200 px-4 text-sm outline-none focus:border-[#00a896] focus:ring-4 focus:ring-[#00a896]/15" required>
                </label>
                <button type="submit" class="w-full rounded-md bg-[#f26419] px-5 py-3 text-sm font-bold text-white transition hover:bg-[#ff7849]">
                    Sign In
                </button>
            </form>
            <p class="mt-5 rounded-xl bg-[#f8f9ff] p-4 text-xs leading-5 text-slate-500">Enter the admin credentials to access package management and client records.</p>
        </section>
    </main>
</body>
</html>
