<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Destinations | {{ config('app.name', 'Aethereal Luxury Travel') }}</title>

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
                <a href="{{ route('destinations') }}" aria-current="page" class="border-b-2 border-[#006b5f] pb-1 font-bold text-[#006b5f]">Destinations</a>
                <a href="{{ route('tour-packages') }}" class="hover:text-[#006b5f]">Tour Packages</a>
                <a href="{{ route('home') }}#planner" class="hover:text-[#006b5f]">AI Planner</a>
                <a href="{{ route('contact') }}" class="hover:text-[#006b5f]">Contact</a>
                <a href="{{ route('client.login') }}" class="hover:text-[#006b5f]">Client Login</a>
            </nav>

            <a href="{{ route('tour-packages') }}" class="rounded-md bg-[#f26419] px-4 py-2.5 text-sm font-bold text-white transition hover:bg-[#ff7849]">
                Browse Tours
            </a>
        </div>
    </header>

    <main>
        <section class="bg-[#0a2540] text-white">
            <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
                <nav class="mb-6 flex items-center gap-2 text-sm text-[#b0c8eb]">
                    <a href="{{ route('home') }}" class="font-semibold text-[#76f4e0]">Home</a>
                    <span>/</span>
                    <span>Destinations</span>
                </nav>

                <p class="text-xs font-bold uppercase tracking-[0.22em] text-[#76f4e0]">Where do you want to go?</p>
                <h1 class="font-display mt-4 max-w-4xl text-4xl font-extrabold leading-tight sm:text-5xl">Explore destinations before choosing your perfect tour package.</h1>
                <p class="mt-5 max-w-3xl text-base leading-7 text-[#d5e3fc]">Use this page for travel inspiration, highlights, best seasons, and destination summaries. When a place feels right, jump into matching bookable packages.</p>
            </div>
        </section>

        <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-[0_12px_24px_-18px_rgba(10,37,64,0.35)]">
                <div class="grid gap-3 md:grid-cols-4">
                    <input id="destinationSearch" type="search" placeholder="Search destination" class="h-12 rounded-xl bg-slate-50 px-4 text-sm outline-none ring-[#00a896]/20 focus:ring-4 md:col-span-2">
                    <select id="destinationRegion" class="h-12 rounded-xl bg-slate-50 px-4 text-sm font-semibold outline-none ring-[#00a896]/20 focus:ring-4">
                        <option value="all">All Regions</option>
                        <option value="philippines">Philippines</option>
                        <option value="asia">Asia</option>
                        <option value="europe">Europe</option>
                        <option value="africa">Africa</option>
                    </select>
                    <a href="{{ route('tour-packages') }}" class="flex h-12 items-center justify-center rounded-xl bg-[#006b5f] px-5 text-sm font-bold text-white transition hover:bg-[#028090]">
                        View Packages
                    </a>
                </div>
            </div>
        </section>

        <section class="mx-auto max-w-7xl px-4 pb-20 sm:px-6 lg:px-8">
            <div id="destinationGrid" class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                @foreach ($destinations as $destination)
                    @php
                        $name = $destination['name'];
                        $country = $destination['country'];
                        $region = $destination['region'];
                        $description = $destination['description'];
                        $tag = $destination['tag'];
                        $count = $destination['count'];
                        $packages = $destination['packages'];
                        $packageSearchText = collect($packages)->pluck('title')->implode(' ');
                    @endphp
                    <article class="destination-card overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-[0_2px_8px_-2px_rgba(10,37,64,0.08)] transition hover:-translate-y-1 hover:shadow-[0_12px_24px_-6px_rgba(10,37,64,0.14)]" data-name="{{ Str::lower($name) }}" data-country="{{ Str::lower($country) }}" data-packages="{{ Str::lower($packageSearchText) }}" data-region="{{ $region }}">
                        <div class="h-48 bg-[linear-gradient(135deg,#0a2540,#00a896)] p-5 text-white">
                            <span class="rounded-full bg-white/15 px-3 py-1 text-xs font-bold">{{ $tag }}</span>
                            <div class="mt-20 h-14 rounded-xl bg-white/15"></div>
                        </div>
                        <div class="p-6">
                            <p class="text-xs font-bold uppercase tracking-[0.14em] text-[#006b5f]">{{ $country }}</p>
                            <h2 class="font-display mt-2 text-2xl font-extrabold text-[#0a2540]">{{ $name }}</h2>
                            <p class="mt-3 text-sm leading-6 text-slate-600">{{ $description }}</p>
                            <div class="mt-5 rounded-xl bg-[#f8f9ff] p-4">
                                <p class="text-xs font-bold uppercase tracking-[0.14em] text-slate-500">Available Packages</p>
                                <div class="mt-3 space-y-2">
                                    @foreach ($packages as $package)
                                        <a href="{{ route('tour.show', $package['slug']) }}" class="flex items-center justify-between gap-3 rounded-lg bg-white px-3 py-2 text-sm font-bold text-[#0a2540] ring-1 ring-slate-200 transition hover:text-[#006b5f]">
                                            <span>{{ $package['title'] }}</span>
                                            <span class="text-xs text-slate-500">{{ $package['price'] }}</span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                            <div class="mt-5 flex items-center justify-between">
                                <span class="text-sm font-bold text-slate-500">{{ $count }}</span>
                                <a href="{{ route('tour-packages') }}" class="rounded-md bg-[#f26419] px-3 py-2 text-xs font-bold text-white transition hover:bg-[#ff7849]">See tours</a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
            <div id="emptyDestinations" class="mt-6 hidden rounded-2xl border border-dashed border-slate-300 bg-white p-8 text-center">
                <h2 class="font-display text-2xl font-extrabold text-[#0a2540]">No destinations found</h2>
                <p class="mt-2 text-sm text-slate-600">Try another region or search keyword.</p>
            </div>
        </section>
    </main>

    <footer class="bg-[#000f22] px-4 py-8 text-white sm:px-6 lg:px-8">
        <div class="mx-auto flex max-w-7xl flex-col justify-between gap-4 md:flex-row md:items-center">
            <p class="font-display font-extrabold">Aethereal Luxury Travel</p>
            <p class="text-sm text-[#b0c8eb]">&copy; {{ date('Y') }} Aethereal Luxury Travel. All rights reserved.</p>
        </div>
    </footer>

    <script>
        const destinationSearch = document.getElementById('destinationSearch');
        const destinationRegion = document.getElementById('destinationRegion');
        const destinationCards = Array.from(document.querySelectorAll('.destination-card'));
        const emptyDestinations = document.getElementById('emptyDestinations');

        function filterDestinations() {
            const keyword = destinationSearch.value.trim().toLowerCase();
            const region = destinationRegion.value;

            const visibleCards = destinationCards.filter((card) => {
                const matchesKeyword = !keyword || `${card.dataset.name} ${card.dataset.country} ${card.dataset.packages}`.includes(keyword);
                const matchesRegion = region === 'all' || card.dataset.region === region;

                return matchesKeyword && matchesRegion;
            });

            destinationCards.forEach((card) => card.classList.add('hidden'));
            visibleCards.forEach((card) => card.classList.remove('hidden'));
            emptyDestinations.classList.toggle('hidden', visibleCards.length > 0);
        }

        destinationSearch.addEventListener('input', filterDestinations);
        destinationRegion.addEventListener('change', filterDestinations);
    </script>
</body>
</html>
