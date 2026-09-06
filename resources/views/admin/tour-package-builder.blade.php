@php
    $isEdit = $mode === 'edit';
    $title = $tour['title'] ?? 'New Signature Tour Package';
    $place = $tour['place'] ?? '';
    $duration = $tour['duration'] ?? '';
    $price = $tour['price'] ?? '';
    $style = $tour['style'] ?? 'Island Escape';
    $description = $tour['description'] ?? '';
    $visibilityStatus = $tour['visibility_status'] ?? 'Active';
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $isEdit ? 'Edit' : 'Add' }} Tour Package | {{ config('app.name', 'Aethereal Luxury Travel') }}</title>

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
            <a href="{{ route('admin.tour-packages.create') }}" class="mt-6 flex items-center justify-center rounded-lg bg-[#0a2540] px-4 py-3 text-sm font-bold text-white">
                Add New Package
            </a>
            <nav class="mt-8 space-y-6 text-sm">
                <div>
                    <p class="mb-2 px-3 text-xs font-bold uppercase tracking-[0.18em] text-slate-400">Overview</p>
                    <a href="{{ route('home') }}" class="flex rounded-lg px-3 py-2 font-semibold text-slate-600 hover:bg-slate-50">Home</a>
                </div>
                <div>
                    <p class="mb-2 px-3 text-xs font-bold uppercase tracking-[0.18em] text-slate-400">Inventory</p>
                    <a href="{{ route('admin.tour-packages') }}" class="flex rounded-lg px-3 py-2 font-semibold text-slate-600 hover:bg-slate-50">Tour Packages</a>
                    <a href="{{ route('destinations') }}" class="mt-1 flex rounded-lg px-3 py-2 font-semibold text-slate-600 hover:bg-slate-50">Destinations</a>
                </div>
                <div>
                    <p class="mb-2 px-3 text-xs font-bold uppercase tracking-[0.18em] text-slate-400">Operations</p>
                    <a href="{{ route('admin.bookings') }}" class="flex rounded-lg px-3 py-2 font-semibold text-slate-600 hover:bg-slate-50">Bookings</a>
                    <a href="{{ route('admin.clients') }}" class="mt-1 flex rounded-lg px-3 py-2 font-semibold text-slate-600 hover:bg-slate-50">Clients</a>
                </div>
            </nav>
            <div class="mt-auto pt-8">
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="flex w-full items-center justify-center rounded-lg border border-slate-200 px-4 py-3 text-sm font-bold text-slate-600 hover:bg-slate-50">
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <main class="pb-28">
            <div class="sticky top-0 z-40 border-b border-slate-200 bg-white/95 px-4 py-4 backdrop-blur-xl sm:px-6 lg:px-8">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <nav class="flex flex-wrap items-center gap-2 text-sm text-slate-500">
                            <a href="{{ route('home') }}" class="font-semibold text-[#006b5f]">Home</a>
                            <span>/</span>
                            <a href="{{ route('admin.tour-packages') }}" class="font-semibold text-[#006b5f]">Tour Packages</a>
                            <span>/</span>
                            <span>{{ $isEdit ? 'Edit Package' : 'Add Package' }}</span>
                        </nav>
                        <div class="mt-2 flex flex-wrap items-center gap-2">
                            <span class="rounded-full bg-[#76f4e0]/30 px-3 py-1 text-xs font-bold uppercase tracking-[0.14em] text-[#006b5f]">{{ $isEdit ? 'Editing Active Inventory' : 'Draft Builder' }}</span>
                            <span class="text-xs font-semibold text-slate-500">Autosave ready</span>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        @if ($isEdit)
                            <a href="{{ route('tour.show', $tour['slug']) }}" class="rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm font-bold text-[#0a2540] hover:bg-slate-50">Preview Public Page</a>
                        @endif
                        <button type="submit" name="status" value="Draft" form="packageBuilderForm" class="save-draft-button rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm font-bold text-[#0a2540] hover:bg-slate-50">Save as Draft</button>
                        <button type="submit" name="status" value="Published" form="packageBuilderForm" class="publish-package-button rounded-lg bg-[#f26419] px-4 py-2 text-sm font-bold text-white hover:bg-[#ff7849]">{{ $isEdit ? 'Publish Changes' : 'Publish Package' }}</button>
                    </div>
                </div>
            </div>

            <section class="px-4 py-8 sm:px-6 lg:px-8">
                <div class="mb-8">
                    <p class="text-xs font-bold uppercase tracking-[0.22em] text-[#006b5f]">Tour package builder</p>
                    <h1 class="font-display mt-2 text-4xl font-extrabold text-[#0a2540]">{{ $isEdit ? 'Edit Tour Package' : 'Add New Tour Package' }}</h1>
                    <p class="mt-2 max-w-3xl text-sm leading-6 text-slate-600">Configure package content, pricing, inventory, itinerary, policies, SEO, and storefront publishing details.</p>
                    @if ($errors->any())
                        <div class="mt-5 rounded-xl border border-red-200 bg-red-50 p-4 text-sm font-semibold text-red-700">
                            Please complete the required package fields before saving.
                        </div>
                    @endif
                </div>

                <div class="grid gap-8 xl:grid-cols-[1fr_360px]">
                    <form id="packageBuilderForm" method="POST" action="{{ $isEdit ? route('admin.tour-packages.update', $tour['slug']) : route('admin.tour-packages.store') }}" class="space-y-6">
                        @csrf
                        @if ($isEdit)
                            @method('PUT')
                        @endif
                        <section id="essentials" class="rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_2px_8px_-2px_rgba(10,37,64,0.08)]">
                            <div class="mb-5 flex items-start justify-between gap-4">
                                <div>
                                    <span class="rounded-lg bg-[#0a2540] px-3 py-1 text-xs font-bold text-white">01</span>
                                    <h2 class="font-display mt-3 text-2xl font-extrabold text-[#0a2540]">Package Essentials</h2>
                                    <p class="mt-1 text-sm text-slate-600">Public-facing name, destination, category, and package summary.</p>
                                </div>
                            </div>
                            <div class="grid gap-5 md:grid-cols-2">
                                <label class="block md:col-span-2">
                                    <span class="text-sm font-bold text-[#0a2540]">Package title</span>
                                    <input name="title" type="text" value="{{ old('title', $title) }}" class="mt-2 h-12 w-full rounded-xl border border-slate-200 px-4 text-sm outline-none focus:border-[#00a896] focus:ring-4 focus:ring-[#00a896]/15" required>
                                    @error('title') <span class="mt-1 block text-xs font-semibold text-red-600">{{ $message }}</span> @enderror
                                </label>
                                <label class="block">
                                    <span class="text-sm font-bold text-[#0a2540]">Destination</span>
                                    <input name="place" type="text" value="{{ old('place', $place) }}" placeholder="El Nido, Philippines" class="mt-2 h-12 w-full rounded-xl border border-slate-200 px-4 text-sm outline-none focus:border-[#00a896] focus:ring-4 focus:ring-[#00a896]/15" required>
                                    @error('place') <span class="mt-1 block text-xs font-semibold text-red-600">{{ $message }}</span> @enderror
                                </label>
                                <label class="block">
                                    <span class="text-sm font-bold text-[#0a2540]">Travel style</span>
                                    <select name="style" class="mt-2 h-12 w-full rounded-xl border border-slate-200 bg-white px-4 text-sm outline-none focus:border-[#00a896] focus:ring-4 focus:ring-[#00a896]/15" required>
                                        @foreach (['Island Escape', 'Culture', 'Luxury Cruise', 'Scenic Rail', 'Wellness', 'Wildlife'] as $option)
                                            <option @selected(old('style', $style) === $option)>{{ $option }}</option>
                                        @endforeach
                                    </select>
                                </label>
                                <label class="block md:col-span-2">
                                    <span class="text-sm font-bold text-[#0a2540]">Short description</span>
                                    <textarea name="description" rows="4" class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-[#00a896] focus:ring-4 focus:ring-[#00a896]/15" required>{{ old('description', $description) }}</textarea>
                                    @error('description') <span class="mt-1 block text-xs font-semibold text-red-600">{{ $message }}</span> @enderror
                                </label>
                            </div>
                        </section>

                        <section id="pricing" class="rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_2px_8px_-2px_rgba(10,37,64,0.08)]">
                            <span class="rounded-lg bg-[#0a2540] px-3 py-1 text-xs font-bold text-white">02</span>
                            <h2 class="font-display mt-3 text-2xl font-extrabold text-[#0a2540]">Pricing & Inventory</h2>
                            <div class="mt-5 grid gap-5 md:grid-cols-3">
                                <label class="block">
                                    <span class="text-sm font-bold text-[#0a2540]">Base price</span>
                                    <input name="price" type="text" value="{{ old('price', $price) }}" placeholder="$1,240" class="mt-2 h-12 w-full rounded-xl border border-slate-200 px-4 text-sm outline-none focus:border-[#00a896] focus:ring-4 focus:ring-[#00a896]/15" required>
                                    @error('price') <span class="mt-1 block text-xs font-semibold text-red-600">{{ $message }}</span> @enderror
                                </label>
                                <label class="block">
                                    <span class="text-sm font-bold text-[#0a2540]">Duration</span>
                                    <input name="duration" type="text" value="{{ old('duration', $duration) }}" placeholder="5 Days / 4 Nights" class="mt-2 h-12 w-full rounded-xl border border-slate-200 px-4 text-sm outline-none focus:border-[#00a896] focus:ring-4 focus:ring-[#00a896]/15" required>
                                    @error('duration') <span class="mt-1 block text-xs font-semibold text-red-600">{{ $message }}</span> @enderror
                                </label>
                                <label class="block">
                                    <span class="text-sm font-bold text-[#0a2540]">Seat capacity</span>
                                    <input type="number" value="12" class="mt-2 h-12 w-full rounded-xl border border-slate-200 px-4 text-sm outline-none focus:border-[#00a896] focus:ring-4 focus:ring-[#00a896]/15">
                                </label>
                                <label class="block">
                                    <span class="text-sm font-bold text-[#0a2540]">Deposit percent</span>
                                    <input type="number" value="20" class="mt-2 h-12 w-full rounded-xl border border-slate-200 px-4 text-sm outline-none focus:border-[#00a896] focus:ring-4 focus:ring-[#00a896]/15">
                                </label>
                                <label class="block">
                                    <span class="text-sm font-bold text-[#0a2540]">Departure date</span>
                                    <input type="date" class="mt-2 h-12 w-full rounded-xl border border-slate-200 px-4 text-sm outline-none focus:border-[#00a896] focus:ring-4 focus:ring-[#00a896]/15">
                                </label>
                                <label class="block">
                                    <span class="text-sm font-bold text-[#0a2540]">Status</span>
                                    <select name="status" class="mt-2 h-12 w-full rounded-xl border border-slate-200 bg-white px-4 text-sm outline-none focus:border-[#00a896] focus:ring-4 focus:ring-[#00a896]/15">
                                        <option @selected(old('status', $tour['status'] ?? 'Draft') === 'Draft')>Draft</option>
                                        <option @selected(old('status', $tour['status'] ?? ($isEdit ? 'Published' : 'Draft')) === 'Published')>Published</option>
                                        <option @selected(old('status', $tour['status'] ?? '') === 'Scheduled')>Scheduled</option>
                                    </select>
                                </label>
                                <label class="block">
                                    <span class="text-sm font-bold text-[#0a2540]">Client visibility</span>
                                    <select name="visibility_status" class="mt-2 h-12 w-full rounded-xl border border-slate-200 bg-white px-4 text-sm outline-none focus:border-[#00a896] focus:ring-4 focus:ring-[#00a896]/15">
                                        <option @selected(old('visibility_status', $visibilityStatus) === 'Active')>Active</option>
                                        <option @selected(old('visibility_status', $visibilityStatus) === 'Inactive')>Inactive</option>
                                    </select>
                                </label>
                            </div>
                        </section>

                        <section id="itinerary" class="rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_2px_8px_-2px_rgba(10,37,64,0.08)]">
                            <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
                                <div>
                                    <span class="rounded-lg bg-[#0a2540] px-3 py-1 text-xs font-bold text-white">03</span>
                                    <h2 class="font-display mt-3 text-2xl font-extrabold text-[#0a2540]">Day-by-Day Itinerary</h2>
                                </div>
                                <button type="button" id="addDayButton" class="rounded-lg bg-[#006b5f] px-4 py-2 text-sm font-bold text-white">Add Itinerary Day</button>
                            </div>
                            <div id="itineraryDays" class="mt-5 space-y-4">
                                @foreach ([['Day 01', 'Arrival, welcome briefing, and hotel check-in'], ['Day 02', 'Signature guided tour and local dining'], ['Day 03', 'Free time, optional add-ons, and sunset experience']] as [$day, $activity])
                                    <div class="itinerary-day rounded-xl bg-[#f8f9ff] p-4">
                                        <div class="flex items-center gap-3">
                                            <span class="rounded-md bg-[#0a2540] px-2 py-1 text-xs font-bold text-white">{{ $day }}</span>
                                            <input type="text" value="{{ $activity }}" class="h-10 flex-1 rounded-lg border border-slate-200 px-3 text-sm outline-none focus:border-[#00a896]">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </section>

                        <section id="policies" class="rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_2px_8px_-2px_rgba(10,37,64,0.08)]">
                            <span class="rounded-lg bg-[#0a2540] px-3 py-1 text-xs font-bold text-white">04</span>
                            <h2 class="font-display mt-3 text-2xl font-extrabold text-[#0a2540]">Inclusions & Policies</h2>
                            <div class="mt-5 grid gap-5 md:grid-cols-2">
                                <label class="block">
                                    <span class="text-sm font-bold text-[#0a2540]">Included items</span>
                                    <textarea rows="5" class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-[#00a896]">Hotel accommodation
Daily breakfast
Private transfers
Local guide</textarea>
                                </label>
                                <label class="block">
                                    <span class="text-sm font-bold text-[#0a2540]">Cancellation policy</span>
                                    <textarea rows="5" class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-[#00a896]">Free cancellation up to 14 days before departure. Deposit terms apply after confirmation.</textarea>
                                </label>
                            </div>
                        </section>

                        <section id="seo" class="rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_2px_8px_-2px_rgba(10,37,64,0.08)]">
                            <span class="rounded-lg bg-[#0a2540] px-3 py-1 text-xs font-bold text-white">05</span>
                            <h2 class="font-display mt-3 text-2xl font-extrabold text-[#0a2540]">SEO & Storefront Badges</h2>
                            <div class="mt-5 grid gap-5">
                                <input type="text" value="{{ $title }} | Aethereal Luxury Travel" class="h-12 rounded-xl border border-slate-200 px-4 text-sm outline-none focus:border-[#00a896]">
                                <textarea rows="3" class="rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-[#00a896]">{{ $description ?: 'Write a clear SEO description for this package.' }}</textarea>
                                <div class="flex flex-wrap gap-2">
                                    @foreach (['Staff Handpicked', 'Best Seller', 'Private Guide', 'Family Friendly'] as $badge)
                                        <label class="rounded-full bg-[#eff4ff] px-3 py-2 text-sm font-semibold text-[#0a2540]"><input type="checkbox" class="mr-2" @checked($loop->first)> {{ $badge }}</label>
                                    @endforeach
                                </div>
                            </div>
                        </section>
                    </form>

                    <aside class="h-fit space-y-5 xl:sticky xl:top-28">
                        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_12px_24px_-18px_rgba(10,37,64,0.35)]">
                            <p class="text-xs font-bold uppercase tracking-[0.18em] text-[#006b5f]">Live Preview</p>
                            <div class="mt-4 overflow-hidden rounded-2xl border border-slate-200">
                                <div class="h-44 bg-[linear-gradient(135deg,#0a2540,#00a896)] p-4 text-white">
                                    <span class="rounded-full bg-white/15 px-3 py-1 text-xs font-bold">{{ $style }}</span>
                                </div>
                                <div class="p-5">
                                    <p class="text-xs font-bold uppercase tracking-[0.14em] text-[#006b5f]">{{ $place ?: 'Destination' }}</p>
                                    <h3 class="font-display mt-2 text-xl font-bold text-[#0a2540]">{{ $title }}</h3>
                                    <p class="mt-3 text-sm leading-6 text-slate-600">{{ $description ?: 'Package summary appears here.' }}</p>
                                    <p class="font-display mt-4 text-2xl font-extrabold text-[#0a2540]">{{ $price ?: '$0' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="rounded-2xl bg-[#0a2540] p-6 text-white">
                            <h2 class="font-display text-xl font-extrabold">Builder checklist</h2>
                            <ul class="mt-4 space-y-3 text-sm text-[#d5e3fc]">
                                <li>Package essentials complete</li>
                                <li>Pricing and inventory configured</li>
                                <li>Itinerary days prepared</li>
                                <li>Policies ready for storefront</li>
                            </ul>
                        </div>
                    </aside>
                </div>
            </section>
        </main>
    </div>

    <div class="fixed bottom-0 left-0 right-0 z-50 border-t border-slate-200 bg-white/95 px-4 py-3 backdrop-blur-xl lg:left-[280px]">
        <div class="mx-auto flex max-w-7xl flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <p class="text-sm font-semibold text-slate-600">{{ $isEdit ? 'Editing package inventory.' : 'New package draft ready.' }}</p>
            <div class="flex gap-3">
                <a href="{{ route('admin.tour-packages') }}" class="rounded-lg px-4 py-2 text-sm font-bold text-slate-600 hover:bg-slate-100">Cancel</a>
                <button type="submit" name="status" value="Draft" form="packageBuilderForm" class="save-draft-button rounded-lg border border-slate-200 px-4 py-2 text-sm font-bold text-[#0a2540]">Save Draft</button>
                <button type="submit" name="status" value="Published" form="packageBuilderForm" class="publish-package-button rounded-lg bg-[#f26419] px-4 py-2 text-sm font-bold text-white">{{ $isEdit ? 'Publish Changes' : 'Publish Package' }}</button>
            </div>
        </div>
    </div>

    <div id="builderStatusMessage" class="hidden fixed right-4 top-24 z-[70] max-w-sm rounded-xl border border-[#76f4e0] bg-white px-5 py-4 text-sm font-bold text-[#006b5f] shadow-xl">
        Package status updated.
    </div>

    <div id="publishModal" class="hidden fixed inset-0 z-[60] bg-[#0a2540]/60 p-4 backdrop-blur-sm">
        <div class="mx-auto mt-24 max-w-xl rounded-2xl bg-white p-6 shadow-2xl">
            <p class="text-xs font-bold uppercase tracking-[0.18em] text-[#006b5f]">Publish workflow</p>
            <h2 class="font-display mt-2 text-2xl font-extrabold text-[#0a2540]">{{ $isEdit ? 'Changes queued for publishing' : 'Package queued for publishing' }}</h2>
            <p class="mt-2 text-sm leading-6 text-slate-600">This prototype confirms the builder flow. Database save and approval workflow can be connected next.</p>
            <div class="mt-6 flex justify-end gap-3">
                <button type="button" id="closePublishModal" class="rounded-lg border border-slate-200 px-4 py-2 text-sm font-bold">Close</button>
                <a href="{{ route('admin.tour-packages') }}" class="rounded-lg bg-[#0a2540] px-4 py-2 text-sm font-bold text-white">Back to Management</a>
            </div>
        </div>
    </div>

    <script>
        const addDayButton = document.getElementById('addDayButton');
        const itineraryDays = document.getElementById('itineraryDays');
        const publishModal = document.getElementById('publishModal');
        const builderStatusMessage = document.getElementById('builderStatusMessage');
        const closePublishModal = document.getElementById('closePublishModal');

        function showBuilderStatus(message) {
            builderStatusMessage.textContent = message;
            builderStatusMessage.classList.remove('hidden');

            window.setTimeout(() => {
                builderStatusMessage.classList.add('hidden');
            }, 2800);
        }

        if (addDayButton && itineraryDays) {
            addDayButton.addEventListener('click', () => {
                const count = itineraryDays.querySelectorAll('.itinerary-day').length + 1;
                const wrapper = document.createElement('div');
                wrapper.className = 'itinerary-day rounded-xl bg-[#f8f9ff] p-4';
                wrapper.innerHTML = `<div class="flex items-center gap-3"><span class="rounded-md bg-[#0a2540] px-2 py-1 text-xs font-bold text-white">Day ${String(count).padStart(2, '0')}</span><input type="text" value="New itinerary activity" class="h-10 flex-1 rounded-lg border border-slate-200 px-3 text-sm outline-none focus:border-[#00a896]"></div>`;
                itineraryDays.appendChild(wrapper);
            });
        }

        document.querySelectorAll('.publish-package-button').forEach((button) => {
            button.addEventListener('click', () => {
                publishModal.classList.remove('hidden');
                showBuilderStatus('{{ $isEdit ? 'Package changes are ready to publish.' : 'Package is ready to publish.' }}');
            });
        });

        document.querySelectorAll('.save-draft-button').forEach((button) => {
            button.addEventListener('click', () => {
                showBuilderStatus('Draft saved for this prototype.');
            });
        });

        if (closePublishModal) {
            closePublishModal.addEventListener('click', () => {
                publishModal.classList.add('hidden');
            });
        }

        if (publishModal) {
            publishModal.addEventListener('click', (event) => {
                if (event.target === publishModal) {
                    publishModal.classList.add('hidden');
                }
            });
        }
    </script>
</body>
</html>
