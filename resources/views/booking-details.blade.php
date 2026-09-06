<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Booking Details | {{ $booking['reference'] }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
</head>
<body class="bg-[#f8f9ff] text-[#0d1c2e] antialiased">
    <header class="border-b border-slate-200 bg-white">
        <div class="mx-auto flex h-20 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <img src="{{ asset('assets/images/abc_travel_agency_logo.png') }}" alt="Aethereal Luxury Travel logo" class="h-14 w-36 rounded-lg object-contain">
            </a>
            <nav class="hidden items-center gap-8 text-sm font-semibold text-slate-600 lg:flex">
                <a href="{{ route('home') }}" class="hover:text-[#006b5f]">Home</a>
                <a href="{{ route('destinations') }}" class="hover:text-[#006b5f]">Destinations</a>
                <a href="{{ route('tour-packages') }}" class="hover:text-[#006b5f]">Tour Packages</a>
                <a href="{{ route('contact') }}" class="hover:text-[#006b5f]">Contact</a>
                <a href="{{ route('client.login') }}" class="hover:text-[#006b5f]">Client Login</a>
            </nav>
        </div>
    </header>

    <main class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="mb-8">
            <p class="text-xs font-bold uppercase tracking-[0.22em] text-[#006b5f]">Booking confirmed</p>
            <h1 class="font-display mt-2 text-4xl font-extrabold text-[#0a2540]">Booking Details</h1>
            <p class="mt-2 text-sm text-slate-600">Reference number: <strong class="text-[#0a2540]">{{ $booking['reference'] }}</strong></p>
        </div>

        <div class="grid gap-8 lg:grid-cols-[1fr_360px]">
            <section class="space-y-6">
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_2px_8px_-2px_rgba(10,37,64,0.08)]">
                    <h2 class="font-display text-2xl font-extrabold text-[#0a2540]">Tour Package</h2>
                    <dl class="mt-5 grid gap-4 text-sm sm:grid-cols-2">
                        <div><dt class="font-bold text-slate-500">Package</dt><dd class="mt-1 font-bold text-[#0a2540]">{{ $booking['tour_title'] }}</dd></div>
                        <div><dt class="font-bold text-slate-500">Destination</dt><dd class="mt-1 text-slate-700">{{ $booking['tour_place'] }}</dd></div>
                        <div><dt class="font-bold text-slate-500">Duration</dt><dd class="mt-1 text-slate-700">{{ $booking['tour_duration'] }}</dd></div>
                        <div><dt class="font-bold text-slate-500">Price</dt><dd class="mt-1 font-bold text-[#0a2540]">{{ $booking['tour_price'] }}</dd></div>
                    </dl>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_2px_8px_-2px_rgba(10,37,64,0.08)]">
                    <h2 class="font-display text-2xl font-extrabold text-[#0a2540]">Guest Information</h2>
                    <dl class="mt-5 grid gap-4 text-sm sm:grid-cols-2">
                        <div><dt class="font-bold text-slate-500">Name</dt><dd class="mt-1 font-bold text-[#0a2540]">{{ $booking['guest_name'] }}</dd></div>
                        <div><dt class="font-bold text-slate-500">Email</dt><dd class="mt-1 text-slate-700">{{ $booking['guest_email'] }}</dd></div>
                        <div><dt class="font-bold text-slate-500">Phone</dt><dd class="mt-1 text-slate-700">{{ $booking['guest_phone'] }}</dd></div>
                        <div><dt class="font-bold text-slate-500">Nationality</dt><dd class="mt-1 text-slate-700">{{ $booking['guest_nationality'] }}</dd></div>
                    </dl>
                </div>
            </section>

            <aside class="h-fit rounded-2xl bg-[#0a2540] p-6 text-white">
                <p class="text-xs font-bold uppercase tracking-[0.18em] text-[#76f4e0]">Payment</p>
                <h2 class="font-display mt-2 text-2xl font-extrabold">{{ ucwords(str_replace('-', ' ', $booking['payment_method'])) }}</h2>
                <p class="mt-3 rounded-xl bg-white/10 p-4 text-sm font-bold text-[#d5e3fc]">{{ $booking['payment_status'] }}</p>
                <p class="mt-5 text-sm text-[#d5e3fc]">Booking status: <strong class="text-white">{{ $booking['booking_status'] }}</strong></p>
            </aside>
        </div>
    </main>
</body>
</html>
