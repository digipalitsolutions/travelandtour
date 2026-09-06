@php
    $clientName = $bookings[0]['guest_name'] ?? null;
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Client Dashboard | {{ config('app.name', 'Aethereal Luxury Travel') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
</head>
<body class="bg-[#f8f9ff] text-[#0d1c2e] antialiased">
    <div class="min-h-screen lg:grid lg:grid-cols-[280px_1fr]">
        <aside class="flex flex-col border-r border-slate-200 bg-white p-5 lg:min-h-screen">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <img src="{{ asset('assets/images/abc_travel_agency_logo.png') }}" alt="Aethereal Luxury Travel logo" class="h-14 w-36 rounded-lg object-contain">
            </a>

            <nav class="mt-8 space-y-6 text-sm">
                <div>
                    <p class="mb-2 px-3 text-xs font-bold uppercase tracking-[0.18em] text-slate-400">Client</p>
                    <a href="{{ route('client.dashboard') }}" aria-current="page" class="flex rounded-lg bg-[#d5e3fc] px-3 py-2 font-bold text-[#0a2540]">My Bookings</a>
                    <a href="{{ route('tour-packages') }}" class="mt-1 flex rounded-lg px-3 py-2 font-semibold text-slate-600 hover:bg-slate-50">Browse Tours</a>
                </div>
                <div>
                    <p class="mb-2 px-3 text-xs font-bold uppercase tracking-[0.18em] text-slate-400">Website</p>
                    <a href="{{ route('home') }}" class="flex rounded-lg px-3 py-2 font-semibold text-slate-600 hover:bg-slate-50">Home</a>
                    <a href="{{ route('contact') }}" class="mt-1 flex rounded-lg px-3 py-2 font-semibold text-slate-600 hover:bg-slate-50">Contact</a>
                </div>
            </nav>
            <div class="mt-auto pt-8">
                <a href="{{ route('client.login') }}" class="flex items-center justify-center rounded-lg border border-slate-200 px-4 py-3 text-sm font-bold text-slate-600 hover:bg-slate-50">
                    Logout
                </a>
            </div>
        </aside>

    <main class="px-4 py-10 sm:px-6 lg:px-8">
        <div class="mb-8">
            <p class="text-xs font-bold uppercase tracking-[0.22em] text-[#006b5f]">Client portal</p>
            <h1 class="font-display mt-2 text-4xl font-extrabold text-[#0a2540]">My Bookings{{ $clientName ? ', Welcome ' . $clientName : '' }}</h1>
            <p class="mt-2 text-sm text-slate-600">View booking references, trip status, and payment notes.</p>
        </div>

        <div class="grid gap-5">
            @forelse ($bookings as $booking)
                <article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_2px_8px_-2px_rgba(10,37,64,0.08)]">
                    <div class="flex flex-col justify-between gap-4 lg:flex-row lg:items-center">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-[0.14em] text-[#006b5f]">{{ $booking['reference'] }}</p>
                            <h2 class="font-display mt-2 text-2xl font-extrabold text-[#0a2540]">{{ $booking['tour_title'] }}</h2>
                            <p class="mt-1 text-sm text-slate-600">{{ $booking['tour_place'] }} • {{ $booking['tour_duration'] }}</p>
                        </div>
                        <div class="flex flex-wrap gap-3">
                            <span class="rounded-full bg-[#76f4e0]/30 px-3 py-1 text-xs font-bold text-[#006b5f]">{{ $booking['booking_status'] }}</span>
                            <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-bold text-slate-600">{{ $booking['payment_status'] }}</span>
                            <a href="{{ route('booking.details', $booking['reference']) }}" class="rounded-md bg-[#f26419] px-4 py-2 text-sm font-bold text-white">View Details</a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-8 text-center">
                    <h2 class="font-display text-2xl font-extrabold text-[#0a2540]">No bookings found</h2>
                    <p class="mt-2 text-sm text-slate-600">Confirmed bookings will appear here after checkout.</p>
                </div>
            @endforelse
        </div>
    </main>
    </div>
</body>
</html>
