<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Client Login | {{ config('app.name', 'Aethereal Luxury Travel') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
</head>
<body class="bg-[#f8f9ff] text-[#0d1c2e] antialiased">
    <header class="sticky top-0 z-50 border-b border-slate-200 bg-white/90 backdrop-blur-xl">
        <div class="mx-auto flex h-20 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <img src="{{ asset('assets/images/abc_travel_agency_logo.png') }}" alt="Aethereal Luxury Travel logo" class="h-14 w-36 rounded-lg object-contain">
                <div>
                    <p class="font-display text-lg font-extrabold leading-5 text-[#0a2540]">Aethereal</p>
                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-[#006b5f]">Luxury Travel</p>
                </div>
            </a>

            <nav class="hidden items-center gap-8 text-sm font-semibold text-slate-600 lg:flex">
                <a href="{{ route('home') }}" class="hover:text-[#006b5f]">Home</a>
                <a href="{{ route('destinations') }}" class="hover:text-[#006b5f]">Destinations</a>
                <a href="{{ route('tour-packages') }}" class="hover:text-[#006b5f]">Tour Packages</a>
                <a href="{{ route('contact') }}" class="hover:text-[#006b5f]">Contact</a>
                <a href="{{ route('client.login') }}" aria-current="page" class="border-b-2 border-[#006b5f] pb-1 font-bold text-[#006b5f]">Client Login</a>
            </nav>
        </div>
    </header>

    <main class="mx-auto grid min-h-[calc(100vh-80px)] max-w-7xl items-center gap-10 px-4 py-12 sm:px-6 lg:grid-cols-[1fr_440px] lg:px-8">
        <section>
            <nav class="mb-5 flex items-center gap-2 text-sm text-slate-500">
                <a href="{{ route('home') }}" class="font-semibold text-[#006b5f]">Home</a>
                <span>/</span>
                <span>Client Login</span>
            </nav>
            <p class="text-xs font-bold uppercase tracking-[0.22em] text-[#006b5f]">Client portal</p>
            <h1 class="font-display mt-3 max-w-2xl text-4xl font-extrabold leading-tight text-[#0a2540] sm:text-5xl">Access your booking details and travel documents.</h1>
            <p class="mt-5 max-w-2xl text-base leading-7 text-slate-600">Clients can use their booking email and reference number to view trip status, payment notes, and confirmed guest information.</p>
        </section>

        <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_12px_24px_-18px_rgba(10,37,64,0.35)]">
            <h2 class="font-display text-2xl font-extrabold text-[#0a2540]">Client Login</h2>
            <form class="mt-6 space-y-5" method="GET" action="{{ route('client.dashboard') }}">
                <label class="block">
                    <span class="text-sm font-bold text-[#0a2540]">Email address</span>
                    <input name="email" type="email" placeholder="guest@example.com" class="mt-2 h-12 w-full rounded-xl border border-slate-200 px-4 text-sm outline-none focus:border-[#00a896] focus:ring-4 focus:ring-[#00a896]/15">
                </label>
                <label class="block">
                    <span class="text-sm font-bold text-[#0a2540]">Booking reference</span>
                    <input name="reference" type="text" placeholder="AET-XXXXXX" class="mt-2 h-12 w-full rounded-xl border border-slate-200 px-4 text-sm uppercase outline-none focus:border-[#00a896] focus:ring-4 focus:ring-[#00a896]/15">
                </label>
                <button type="submit" class="w-full rounded-md bg-[#f26419] px-5 py-3 text-sm font-bold text-white transition hover:bg-[#ff7849]">
                    Sign In
                </button>
            </form>
            <p class="mt-5 rounded-xl bg-[#f8f9ff] p-4 text-xs leading-5 text-slate-500">Login validation will be connected when full client authentication is added. For now, clients can open their booking details from the confirmation link.</p>
        </section>
    </main>
</body>
</html>
