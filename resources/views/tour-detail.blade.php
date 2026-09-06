<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $tour['title'] }} | {{ config('app.name', 'Aethereal Luxury Travel') }}</title>

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
                <a href="{{ route('tour-packages') }}" aria-current="page" class="border-b-2 border-[#006b5f] pb-1 font-bold text-[#006b5f]">Tour Packages</a>
                <a href="{{ route('contact') }}" class="hover:text-[#006b5f]">Contact</a>
                <a href="{{ route('client.login') }}" class="hover:text-[#006b5f]">Client Login</a>
            </nav>

            <a href="{{ route('booking.checkout', $tour['slug']) }}" class="rounded-md bg-[#f26419] px-4 py-2.5 text-sm font-bold text-white transition hover:bg-[#ff7849]">
                Book
            </a>
        </div>
    </header>

    <main>
        <section class="border-b border-slate-200 bg-white">
            <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
                <nav class="mb-5 flex flex-wrap items-center gap-2 text-sm text-slate-500">
                    <a href="{{ route('home') }}" class="font-semibold text-[#006b5f]">Home</a>
                    <span>/</span>
                    <a href="{{ route('tour-packages') }}" class="font-semibold text-[#006b5f]">Tour Packages</a>
                    <span>/</span>
                    <span>{{ $tour['title'] }}</span>
                </nav>

                <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                    <div class="max-w-4xl">
                        <div class="flex flex-wrap gap-2">
                            <span class="rounded-full bg-[#76f4e0]/35 px-3 py-1 text-xs font-bold uppercase tracking-[0.14em] text-[#006b5f]">{{ $tour['style'] }}</span>
                            <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-bold text-slate-600">{{ $tour['duration'] }}</span>
                        </div>
                        <h1 class="font-display mt-4 text-4xl font-extrabold leading-tight text-[#0a2540] sm:text-5xl">{{ $tour['title'] }}</h1>
                        <p class="mt-4 text-base leading-7 text-slate-600">{{ $tour['description'] }}</p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-[#f8f9ff] p-4">
                        <p class="text-sm font-bold text-[#0a2540]">{{ $tour['rating'] }}/5.0 verified rating</p>
                        <p class="text-sm text-slate-500">{{ $tour['place'] }}</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            <div class="grid gap-4 lg:grid-cols-12">
                <div class="min-h-[360px] rounded-2xl bg-[linear-gradient(135deg,#0a2540,#00a896)] p-6 text-white shadow-[0_20px_32px_-16px_rgba(10,37,64,0.35)] lg:col-span-8">
                    <div class="flex h-full min-h-[320px] flex-col justify-between">
                        <span class="w-fit rounded-full bg-white/15 px-3 py-1 text-xs font-bold">Signature route</span>
                        <div>
                            <p class="text-sm font-semibold text-[#d5e3fc]">{{ $tour['place'] }}</p>
                            <h2 class="font-display mt-2 max-w-2xl text-3xl font-extrabold">Premium guided experience with curated stays and local experts.</h2>
                        </div>
                    </div>
                </div>

                <aside id="booking" class="rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_12px_24px_-18px_rgba(10,37,64,0.35)] lg:col-span-4">
                    <p class="text-sm font-semibold text-slate-500">From</p>
                    <p class="font-display mt-1 text-4xl font-extrabold text-[#0a2540]">{{ $tour['price'] }} <span class="text-sm font-medium text-slate-500">/ traveler</span></p>
                    <div class="mt-5 space-y-3 text-sm text-slate-600">
                        <div class="flex justify-between"><span>Duration</span><strong class="text-[#0a2540]">{{ $tour['duration'] }}</strong></div>
                        <div class="flex justify-between"><span>Location</span><strong class="text-[#0a2540]">{{ $tour['place'] }}</strong></div>
                        <div class="flex justify-between"><span>Style</span><strong class="text-[#0a2540]">{{ $tour['style'] }}</strong></div>
                    </div>
                    <form class="mt-6 space-y-4" method="GET" action="{{ route('booking.checkout', $tour['slug']) }}">
                        <label class="block">
                            <span class="text-sm font-bold text-[#0a2540]">Preferred departure</span>
                            <select class="mt-2 h-12 w-full rounded-xl border border-slate-200 bg-white px-3 text-sm outline-none focus:border-[#00a896] focus:ring-4 focus:ring-[#00a896]/15">
                                <option>Next available date</option>
                                <option>Private custom date</option>
                                <option>Holiday season</option>
                            </select>
                        </label>
                        <button type="submit" class="w-full rounded-md bg-[#f26419] px-5 py-3 text-sm font-bold text-white transition hover:bg-[#ff7849]">
                            Book Now
                        </button>
                    </form>
                    <p class="mt-3 text-center text-xs text-slate-500">Secure inquiry. Final booking flow will be connected next.</p>
                </aside>
            </div>
        </section>

        <section class="mx-auto grid max-w-7xl gap-8 px-4 pb-20 sm:px-6 lg:grid-cols-[1fr_360px] lg:px-8">
            <div class="space-y-6">
                <section class="rounded-2xl border border-slate-200 bg-white p-6">
                    <h2 class="font-display text-2xl font-extrabold text-[#0a2540]">Trip Highlights</h2>
                    <div class="mt-5 grid gap-4 sm:grid-cols-2">
                        @foreach (['Private local guide', 'Boutique accommodation', 'Daily curated activities', 'Airport and tour transfers'] as $highlight)
                            <div class="rounded-xl bg-[#f8f9ff] p-4 text-sm font-semibold text-slate-700">{{ $highlight }}</div>
                        @endforeach
                    </div>
                </section>

                <section class="rounded-2xl border border-slate-200 bg-white p-6">
                    <h2 class="font-display text-2xl font-extrabold text-[#0a2540]">Sample Itinerary</h2>
                    <div class="mt-5 space-y-4">
                        @foreach ([
                            ['Day 1', 'Arrival and welcome briefing'],
                            ['Day 2', 'Signature destination experience'],
                            ['Day 3', 'Private guided exploration'],
                            ['Final Day', 'Slow breakfast and assisted departure'],
                        ] as [$day, $activity])
                            <div class="border-l-4 border-[#00a896] bg-[#f8f9ff] p-4">
                                <p class="text-sm font-bold text-[#006b5f]">{{ $day }}</p>
                                <p class="mt-1 text-sm text-slate-600">{{ $activity }}</p>
                            </div>
                        @endforeach
                    </div>
                </section>
            </div>

            <aside class="h-fit rounded-2xl bg-[#0a2540] p-6 text-white">
                <h2 class="font-display text-2xl font-extrabold">Need custom dates?</h2>
                <p class="mt-3 text-sm leading-6 text-[#d5e3fc]">This detail page is ready for a booking form, payment steps, and traveler information in the next phase.</p>
                <a href="{{ route('tour-packages') }}" class="mt-5 inline-flex rounded-md bg-white px-4 py-2.5 text-sm font-bold text-[#0a2540]">Back to packages</a>
            </aside>
        </section>
    </main>

    <footer class="bg-[#000f22] px-4 py-8 text-white sm:px-6 lg:px-8">
        <div class="mx-auto flex max-w-7xl flex-col justify-between gap-4 md:flex-row md:items-center">
            <p class="font-display font-extrabold">Aethereal Luxury Travel</p>
            <p class="text-sm text-[#b0c8eb]">&copy; {{ date('Y') }} Aethereal Luxury Travel. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
