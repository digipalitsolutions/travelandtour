<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Aethereal Luxury Travel') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
</head>
<body class="bg-[#f8f9ff] text-[#0d1c2e] antialiased">
    <header class="fixed inset-x-0 top-0 z-50 border-b border-white/50 bg-white/90 backdrop-blur-xl">
        <div class="mx-auto flex h-20 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <img src="{{ asset('assets/images/abc_travel_agency_logo.png') }}" alt="Aethereal Luxury Travel logo" class="h-14 w-36 rounded-lg object-contain">
                <div>
                    <p class="font-display text-lg font-extrabold leading-5 text-[#0a2540]">Aethereal</p>
                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-[#006b5f]">Luxury Travel</p>
                </div>
            </a>

            <nav class="hidden items-center gap-8 text-sm font-semibold text-slate-600 lg:flex">
                <a href="{{ route('home') }}" aria-current="page" class="border-b-2 border-[#006b5f] pb-1 font-bold text-[#006b5f]">Home</a>
                <a href="{{ route('destinations') }}" class="hover:text-[#006b5f]">Destinations</a>
                <a href="{{ route('tour-packages') }}" class="hover:text-[#006b5f]">Tour Packages</a>
                <a href="{{ route('contact') }}" class="hover:text-[#006b5f]">Contact</a>
                <a href="{{ route('client.login') }}" class="hover:text-[#006b5f]">Client Login</a>
            </nav>

            <a href="{{ route('tour-packages') }}" class="rounded-md bg-[#f26419] px-4 py-2.5 text-sm font-bold text-white shadow-[0_12px_24px_-12px_rgba(242,100,25,0.65)] transition hover:bg-[#ff7849]">
                Browse Tours
            </a>
        </div>
    </header>

    <main>
        <section class="relative isolate overflow-hidden bg-[#0a2540] pt-28 text-white">
            <div class="absolute inset-0 -z-10 bg-[radial-gradient(circle_at_top_left,rgba(0,168,150,0.35),transparent_34%),linear-gradient(135deg,rgba(10,37,64,0.95),rgba(0,15,34,0.92))]"></div>
            <div class="mx-auto grid max-w-7xl gap-10 px-4 pb-14 pt-14 sm:px-6 lg:grid-cols-[1.05fr_0.95fr] lg:px-8 lg:pb-20 lg:pt-20">
                <div class="flex flex-col justify-center">
                    <p class="mb-5 inline-flex w-fit rounded-full border border-white/20 bg-white/10 px-3 py-1 text-xs font-bold uppercase tracking-[0.22em] text-[#76f4e0]">
                        Bespoke expeditions
                    </p>
                    <h1 class="font-display max-w-3xl text-4xl font-extrabold leading-tight sm:text-5xl lg:text-6xl">
                        Discover beautiful places with travel planned around your vibe.
                    </h1>
                    <p class="mt-6 max-w-2xl text-lg leading-8 text-[#d5e3fc]">
                        Curated island escapes, cultural journeys, and private luxury tours designed for travelers who want the details handled beautifully.
                    </p>

                    <div class="mt-8 flex flex-wrap gap-3">
                        <a href="{{ route('tour-packages') }}" class="rounded-md bg-[#f26419] px-5 py-3 text-sm font-bold text-white transition hover:bg-[#ff7849]">Explore Packages</a>
                        <a href="{{ route('destinations') }}" class="rounded-md border border-white/25 px-5 py-3 text-sm font-bold text-white transition hover:bg-white/10">View Destinations</a>
                    </div>
                </div>

                <div class="rounded-2xl border border-white/15 bg-white/10 p-4 shadow-[0_28px_48px_-12px_rgba(0,0,0,0.35)] backdrop-blur">
                    <div class="overflow-hidden rounded-xl bg-white">
                        <img src="{{ asset('assets/images/abc_travel_agency_logo.png') }}" alt="Aethereal Luxury Travel compass emblem" class="mx-auto aspect-[4/3] w-full max-w-lg object-contain p-10">
                    </div>
                    <div class="mt-4 grid grid-cols-3 gap-3 text-center">
                        <div class="rounded-lg bg-white/10 p-3">
                            <p class="font-display text-2xl font-extrabold">60+</p>
                            <p class="text-xs text-[#d5e3fc]">Countries</p>
                        </div>
                        <div class="rounded-lg bg-white/10 p-3">
                            <p class="font-display text-2xl font-extrabold">4.9</p>
                            <p class="text-xs text-[#d5e3fc]">Rating</p>
                        </div>
                        <div class="rounded-lg bg-white/10 p-3">
                            <p class="font-display text-2xl font-extrabold">24/7</p>
                            <p class="text-xs text-[#d5e3fc]">Support</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="relative z-10 -mt-8 px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-6xl rounded-2xl border border-slate-200 bg-white p-4 shadow-[0_20px_32px_-16px_rgba(10,37,64,0.22)]">
                <div class="grid gap-3 md:grid-cols-4">
                    <label class="block rounded-lg bg-slate-50 p-4">
                        <span class="text-xs font-bold uppercase tracking-[0.14em] text-slate-500">Destination</span>
                        <input type="text" placeholder="El Nido, Kyoto, Amalfi" class="mt-2 w-full bg-transparent text-sm font-semibold outline-none placeholder:text-slate-400">
                    </label>
                    <label class="block rounded-lg bg-slate-50 p-4">
                        <span class="text-xs font-bold uppercase tracking-[0.14em] text-slate-500">Travel Date</span>
                        <input type="text" placeholder="Choose dates" class="mt-2 w-full bg-transparent text-sm font-semibold outline-none placeholder:text-slate-400">
                    </label>
                    <label class="block rounded-lg bg-slate-50 p-4">
                        <span class="text-xs font-bold uppercase tracking-[0.14em] text-slate-500">Travelers</span>
                        <select class="mt-2 w-full bg-transparent text-sm font-semibold outline-none">
                            <option>2 Adults</option>
                            <option>Solo traveler</option>
                            <option>Family group</option>
                        </select>
                    </label>
                    <button class="rounded-lg bg-[#006b5f] px-5 py-4 text-sm font-bold text-white transition hover:bg-[#028090]">
                        Search Tours
                    </button>
                </div>
            </div>
        </section>

        <section id="destinations" class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
            <div class="mb-10 flex flex-col justify-between gap-4 md:flex-row md:items-end">
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.22em] text-[#006b5f]">Featured destinations</p>
                    <h2 class="font-display mt-3 text-3xl font-extrabold text-[#0a2540] sm:text-4xl">Journeys worth clearing your calendar for</h2>
                </div>
                <p class="max-w-md text-sm leading-6 text-slate-600">A premium starter homepage with destination cards ready to connect to real packages, pricing, and booking flows.</p>
            </div>

            <div class="grid gap-6 md:grid-cols-3">
                @foreach ([
                    ['Palawan Island Escape', 'Philippines', 'Turquoise lagoons, limestone cliffs, and private boat days.', '$1,240'],
                    ['Kyoto Heritage Trail', 'Japan', 'Tea houses, temples, ryokan stays, and quiet garden mornings.', '$2,180'],
                    ['Amalfi Coast Cruise', 'Italy', 'Cliffside villages, skipper-led coves, and sunset dining.', '$2,950'],
                ] as [$title, $place, $description, $price])
                    <article class="group overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-[0_2px_8px_-2px_rgba(10,37,64,0.08)] transition hover:-translate-y-1 hover:shadow-[0_12px_24px_-6px_rgba(10,37,64,0.14)]">
                        <div class="h-52 bg-[linear-gradient(135deg,#0a2540,#00a896)] p-6 text-white">
                            <span class="rounded-full bg-white/15 px-3 py-1 text-xs font-bold">{{ $place }}</span>
                            <div class="mt-20 h-16 rounded-xl bg-white/15"></div>
                        </div>
                        <div class="p-6">
                            <h3 class="font-display text-xl font-bold text-[#0a2540]">{{ $title }}</h3>
                            <p class="mt-3 text-sm leading-6 text-slate-600">{{ $description }}</p>
                            <div class="mt-5 flex items-center justify-between">
                                <p class="font-display text-lg font-extrabold text-[#0a2540]">From {{ $price }} <span class="text-xs font-medium text-slate-500">/ traveler</span></p>
                                <a href="{{ route('tour-packages') }}" class="text-sm font-bold text-[#006b5f]">View</a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>

        <section id="packages" class="bg-white py-20">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="grid gap-10 lg:grid-cols-[0.9fr_1.1fr] lg:items-center">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.22em] text-[#f26419]">Why book with us</p>
                        <h2 class="font-display mt-3 text-3xl font-extrabold text-[#0a2540] sm:text-4xl">Luxury service with practical booking clarity</h2>
                        <p class="mt-5 text-base leading-7 text-slate-600">Every trip page can grow from here: package inventory, itinerary timelines, payment reminders, travel documents, and client booking details.</p>
                    </div>
                    <div class="grid gap-4 sm:grid-cols-2">
                        @foreach ([
                            ['Private planning', 'Custom itineraries shaped around pace, budget, and interests.'],
                            ['Verified operators', 'Trusted local partners, safety checks, and clear inclusions.'],
                            ['Flexible support', 'Human assistance before, during, and after the journey.'],
                            ['Shared-hosting ready', 'Laravel Blade, public assets, CDN styling, and no Node requirement.'],
                        ] as [$title, $text])
                            <div class="rounded-2xl border border-slate-200 bg-[#f8f9ff] p-5">
                                <h3 class="font-display text-lg font-bold text-[#0a2540]">{{ $title }}</h3>
                                <p class="mt-2 text-sm leading-6 text-slate-600">{{ $text }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

    </main>

    <footer id="contact" class="bg-[#000f22] px-4 py-10 text-white sm:px-6 lg:px-8">
        <div class="mx-auto flex max-w-7xl flex-col justify-between gap-6 md:flex-row md:items-center">
            <div class="flex items-center gap-3">
                <img src="{{ asset('assets/images/abc_travel_agency_logo.png') }}" alt="Aethereal Luxury Travel logo" class="h-10 w-10 rounded-lg bg-white object-contain">
                <div>
                    <p class="font-display font-extrabold">Aethereal Luxury Travel</p>
                    <p class="text-sm text-[#b0c8eb]">Curated tours, private escapes, and premium travel care.</p>
                </div>
            </div>
            <p class="text-sm text-[#b0c8eb]">&copy; {{ date('Y') }} Aethereal Luxury Travel. All rights reserved.</p>
        </div>
    </footer>

    <script src="{{ asset('assets/js/app.js') }}"></script>
</body>
</html>
