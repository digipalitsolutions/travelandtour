<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tour Packages | {{ config('app.name', 'Aethereal Luxury Travel') }}</title>

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
                <a href="{{ route('home') }}#planner" class="hover:text-[#006b5f]">AI Planner</a>
                <a href="{{ route('contact') }}" class="hover:text-[#006b5f]">Contact</a>
                <a href="{{ route('client.login') }}" class="hover:text-[#006b5f]">Client Login</a>
            </nav>

            <a href="{{ route('home') }}#planner" class="rounded-md bg-[#f26419] px-4 py-2.5 text-sm font-bold text-white transition hover:bg-[#ff7849]">
                Plan My Trip
            </a>
        </div>
    </header>

    <main>
        <section class="border-b border-slate-200 bg-white">
            <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
                <nav class="mb-5 flex items-center gap-2 text-sm text-slate-500">
                    <a href="{{ route('home') }}" class="font-semibold text-[#006b5f]">Home</a>
                    <span>/</span>
                    <span>Tour Packages</span>
                </nav>

                <div class="flex flex-col justify-between gap-6 lg:flex-row lg:items-end">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.22em] text-[#006b5f]">Handpicked itineraries</p>
                        <h1 class="font-display mt-3 text-4xl font-extrabold text-[#0a2540] sm:text-5xl">Explore handcrafted tour packages</h1>
                        <p class="mt-4 max-w-3xl text-base leading-7 text-slate-600">Discover curated private and small-group journeys led by trusted local guides, with clear inclusions, premium stays, and flexible planning support.</p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-[#f8f9ff] p-4">
                        <p class="text-sm font-bold text-[#0a2540]">4.96/5.0 guest rating</p>
                        <p class="text-sm text-slate-500">2,400+ travelers served</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-[0_12px_24px_-18px_rgba(10,37,64,0.35)]">
                <div class="grid gap-3 lg:grid-cols-12">
                    <input id="packageSearch" type="search" placeholder="Search by destination, activity, or keyword" class="h-12 rounded-xl bg-slate-50 px-4 text-sm outline-none ring-[#00a896]/20 focus:ring-4 lg:col-span-6">
                    <select id="packageSort" class="h-12 rounded-xl bg-slate-50 px-4 text-sm font-semibold outline-none ring-[#00a896]/20 focus:ring-4 lg:col-span-3">
                        <option value="popular">Most Popular</option>
                        <option value="price">Price: Low to High</option>
                        <option value="rated">Highest Rated</option>
                    </select>
                    <button id="applyPackageFilters" type="button" class="h-12 rounded-xl bg-[#006b5f] px-5 text-sm font-bold text-white transition hover:bg-[#028090] lg:col-span-3">Apply Filters</button>
                </div>
            </div>
        </section>

        <section class="mx-auto grid max-w-7xl gap-8 px-4 pb-20 sm:px-6 lg:grid-cols-[280px_1fr] lg:px-8">
            <aside class="h-fit rounded-2xl border border-slate-200 bg-white p-5 shadow-[0_2px_8px_-2px_rgba(10,37,64,0.08)]">
                <h2 class="font-display text-xl font-bold text-[#0a2540]">Filter Expeditions</h2>
                <div class="mt-5 space-y-5">
                    <div>
                        <p class="mb-3 text-sm font-bold text-slate-700">Region</p>
                        <label class="flex gap-2 text-sm text-slate-600"><input type="checkbox" name="region" value="philippines" checked> Philippines</label>
                        <label class="mt-2 flex gap-2 text-sm text-slate-600"><input type="checkbox" name="region" value="asia"> Asia</label>
                        <label class="mt-2 flex gap-2 text-sm text-slate-600"><input type="checkbox" name="region" value="europe"> Europe</label>
                        <label class="mt-2 flex gap-2 text-sm text-slate-600"><input type="checkbox" name="region" value="africa"> Africa</label>
                    </div>
                    <div>
                        <p class="mb-3 text-sm font-bold text-slate-700">Local Destinations</p>
                        <label class="flex gap-2 text-sm text-slate-600"><input type="checkbox" name="local_destination" value="palawan"> Palawan</label>
                        <label class="mt-2 flex gap-2 text-sm text-slate-600"><input type="checkbox" name="local_destination" value="boracay"> Boracay</label>
                        <label class="mt-2 flex gap-2 text-sm text-slate-600"><input type="checkbox" name="local_destination" value="cebu"> Cebu</label>
                        <p class="mt-2 text-xs leading-5 text-slate-400">Used only when Philippines is selected.</p>
                    </div>
                    <div>
                        <p class="mb-3 text-sm font-bold text-slate-700">Travel Style</p>
                        <label class="flex gap-2 text-sm text-slate-600"><input type="checkbox" name="style" value="island escape"> Luxury Island Escape</label>
                        <label class="mt-2 flex gap-2 text-sm text-slate-600"><input type="checkbox" name="style" value="culture"> Culture & Heritage</label>
                        <label class="mt-2 flex gap-2 text-sm text-slate-600"><input type="checkbox" name="style" value="wildlife"> Wildlife Safari</label>
                    </div>
                </div>
            </aside>

            <div>
                <div class="mb-5 flex items-center justify-between gap-4">
                    <p id="packageCount" class="text-sm text-slate-600">Showing <strong class="text-[#0a2540]">{{ count($tours) }}</strong> of <strong class="text-[#0a2540]">{{ count($tours) }}</strong> tour packages</p>
                    <a href="{{ route('home') }}" class="text-sm font-bold text-[#006b5f]">Back to homepage</a>
                </div>

                <div id="packageGrid" class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                    @foreach ($tours as $tour)
                        @php
                            $slug = $tour['slug'];
                            $title = $tour['title'];
                            $place = $tour['place'];
                            $duration = $tour['duration'];
                            $price = $tour['price'];
                            $style = $tour['style'];
                            $rating = $tour['rating'] ?? '4.90';
                            $placeLower = Str::lower($place);
                            $region = Str::contains($placeLower, ['philippines', 'palawan', 'el nido', 'boracay', 'cebu', 'bohol', 'siargao', 'coron', 'manila']) ? 'philippines' : (Str::contains($placeLower, ['italy', 'switzerland']) ? 'europe' : (Str::contains($placeLower, ['tanzania', 'africa']) ? 'africa' : 'asia'));
                            $localDestination = '';
                            if ($region === 'philippines') {
                                $localDestination = Str::contains($placeLower, ['palawan', 'el nido', 'coron']) ? 'palawan' : (Str::contains($placeLower, 'boracay') ? 'boracay' : (Str::contains($placeLower, 'cebu') ? 'cebu' : Str::lower(Str::before($place, ','))));
                            }
                        @endphp
                        <article class="package-card overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-[0_2px_8px_-2px_rgba(10,37,64,0.08)] transition hover:-translate-y-1 hover:shadow-[0_12px_24px_-6px_rgba(10,37,64,0.14)]" data-title="{{ Str::lower($title) }}" data-place="{{ Str::lower($place) }}" data-style="{{ Str::lower($style) }}" data-region="{{ $region }}" data-local-destination="{{ $localDestination }}" data-price="{{ preg_replace('/[^0-9]/', '', $price) }}" data-rating="{{ $rating }}">
                            <div class="relative h-48 bg-[linear-gradient(135deg,#0a2540,#00a896)] p-4 text-white">
                                <span class="rounded-full bg-white/15 px-3 py-1 text-xs font-bold">{{ $style }}</span>
                                <span class="absolute bottom-4 left-4 rounded-lg bg-[#0a2540]/75 px-3 py-1 text-xs font-bold">{{ $duration }}</span>
                            </div>
                            <div class="p-5">
                                <p class="text-xs font-bold uppercase tracking-[0.14em] text-[#006b5f]">{{ $place }}</p>
                                <h3 class="font-display mt-2 text-xl font-bold text-[#0a2540]">{{ $title }}</h3>
                                <p class="mt-3 text-sm leading-6 text-slate-600">Private planning, trusted local guides, clear inclusions, and 24/7 travel support.</p>
                                <div class="mt-5 flex items-end justify-between">
                                    <p class="font-display text-2xl font-extrabold text-[#0a2540]">{{ $price }} <span class="text-xs font-medium text-slate-500">/ traveler</span></p>
                                    <a href="{{ route('tour.show', $slug) }}" class="rounded-md bg-[#f26419] px-3 py-2 text-xs font-bold text-white transition hover:bg-[#ff7849]">Quick Book</a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div id="emptyPackages" class="hidden rounded-2xl border border-dashed border-slate-300 bg-white p-8 text-center">
                    <h3 class="font-display text-2xl font-bold text-[#0a2540]">No packages match those filters</h3>
                    <p class="mt-2 text-sm text-slate-600">Try selecting another region, style, or search keyword.</p>
                </div>
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
        const packageSearch = document.querySelector('#packageSearch');
        const packageSort = document.querySelector('#packageSort');
        const applyPackageFilters = document.querySelector('#applyPackageFilters');
        const packageGrid = document.querySelector('#packageGrid');
        const packageCount = document.querySelector('#packageCount');
        const emptyPackages = document.querySelector('#emptyPackages');
        const packageCards = Array.from(document.querySelectorAll('.package-card'));

        function checkedValues(name) {
            return Array.from(document.querySelectorAll(`input[name="${name}"]:checked`)).map((input) => input.value);
        }

        function applyFilters() {
            const keyword = packageSearch.value.trim().toLowerCase();
            const selectedRegions = checkedValues('region');
            const selectedLocalDestinations = checkedValues('local_destination');
            const selectedStyles = checkedValues('style');

            let visibleCards = packageCards.filter((card) => {
                const searchableText = `${card.dataset.title} ${card.dataset.place} ${card.dataset.style}`;
                const matchesKeyword = !keyword || searchableText.includes(keyword);
                const matchesRegion = selectedRegions.length === 0 || selectedRegions.includes(card.dataset.region);
                const matchesLocalDestination = card.dataset.region !== 'philippines' || selectedLocalDestinations.length === 0 || selectedLocalDestinations.includes(card.dataset.localDestination);
                const matchesStyle = selectedStyles.length === 0 || selectedStyles.some((style) => card.dataset.style.includes(style));

                return matchesKeyword && matchesRegion && matchesLocalDestination && matchesStyle;
            });

            visibleCards.sort((first, second) => {
                if (packageSort.value === 'price') {
                    return Number(first.dataset.price) - Number(second.dataset.price);
                }

                if (packageSort.value === 'rated') {
                    return Number(second.dataset.rating) - Number(first.dataset.rating);
                }

                return packageCards.indexOf(first) - packageCards.indexOf(second);
            });

            packageCards.forEach((card) => card.classList.add('hidden'));
            visibleCards.forEach((card) => {
                card.classList.remove('hidden');
                packageGrid.appendChild(card);
            });

            packageCount.innerHTML = `Showing <strong class="text-[#0a2540]">${visibleCards.length}</strong> of <strong class="text-[#0a2540]">${packageCards.length}</strong> tour packages`;
            emptyPackages.classList.toggle('hidden', visibleCards.length > 0);
        }

        applyPackageFilters.addEventListener('click', applyFilters);
        packageSort.addEventListener('change', applyFilters);
        packageSearch.addEventListener('keydown', (event) => {
            if (event.key === 'Enter') {
                event.preventDefault();
                applyFilters();
            }
        });

        applyFilters();
    </script>
</body>
</html>
