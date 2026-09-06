<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tour Package Management | {{ config('app.name', 'Aethereal Luxury Travel') }}</title>

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
                    <a href="{{ route('tour-packages') }}" class="flex rounded-lg px-3 py-2 font-semibold text-slate-600 hover:bg-slate-50">Public Tour Packages</a>
                </div>
                <div>
                    <p class="mb-2 px-3 text-xs font-bold uppercase tracking-[0.18em] text-slate-400">Inventory</p>
                    <a href="{{ route('admin.tour-packages') }}" aria-current="page" class="flex items-center justify-between rounded-lg bg-[#d5e3fc] px-3 py-2 font-bold text-[#0a2540]">
                        <span>Tour Packages</span>
                        <span class="rounded-full bg-white px-2 py-0.5 text-xs">{{ count($tours) }}</span>
                    </a>
                    <a href="{{ route('destinations') }}" class="mt-1 flex rounded-lg px-3 py-2 font-semibold text-slate-600 hover:bg-slate-50">Destinations</a>
                </div>
                <div>
                    <p class="mb-2 px-3 text-xs font-bold uppercase tracking-[0.18em] text-slate-400">Operations</p>
                    <a href="{{ route('admin.bookings') }}" class="flex rounded-lg px-3 py-2 font-semibold text-slate-600 hover:bg-slate-50">Bookings</a>
                    <a href="{{ route('admin.clients') }}" class="mt-1 flex rounded-lg px-3 py-2 font-semibold text-slate-600 hover:bg-slate-50">Clients</a>
                    <a href="{{ route('contact') }}" class="mt-1 flex rounded-lg px-3 py-2 font-semibold text-slate-600 hover:bg-slate-50">Customer Inquiries</a>
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

        <main class="min-w-0">
            <header class="sticky top-0 z-40 border-b border-slate-200 bg-white/90 px-4 py-4 backdrop-blur-xl sm:px-6 lg:px-8">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                    <div class="relative max-w-xl flex-1">
                        <input id="catalogSearchInput" type="search" placeholder="Search packages, destinations, or styles" class="h-11 w-full rounded-xl bg-slate-50 px-4 text-sm outline-none focus:ring-4 focus:ring-[#00a896]/15">
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="rounded-full bg-[#76f4e0]/30 px-3 py-1 text-xs font-bold text-[#006b5f]">Live Catalog</span>
                        <a href="{{ route('tour-packages') }}" class="rounded-lg border border-slate-200 px-4 py-2 text-sm font-bold text-[#0a2540] hover:bg-slate-50">View Public Website</a>
                    </div>
                </div>
            </header>

            <section class="px-4 py-8 sm:px-6 lg:px-8">
                <div class="mb-8 flex flex-col justify-between gap-5 lg:flex-row lg:items-end">
                    <div>
                        <nav class="mb-3 flex items-center gap-2 text-sm text-slate-500">
                            <a href="{{ route('home') }}" class="font-semibold text-[#006b5f]">Home</a>
                            <span>/</span>
                            <span>Manager Portal</span>
                            <span>/</span>
                            <span>Tour Packages</span>
                        </nav>
                        <p class="text-xs font-bold uppercase tracking-[0.22em] text-[#006b5f]">Inventory catalog management</p>
                        <h1 class="font-display mt-2 text-4xl font-extrabold text-[#0a2540]">Tour Package Management</h1>
                        <p class="mt-2 max-w-3xl text-sm leading-6 text-slate-600">Manage, publish, duplicate, archive, and audit all luxury tour packages across global destinations.</p>
                        @if (session('status'))
                            <div class="mt-5 rounded-xl border border-[#76f4e0] bg-[#76f4e0]/20 px-4 py-3 text-sm font-bold text-[#006b5f]">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <button type="button" class="rounded-lg bg-white px-4 py-2.5 text-sm font-bold text-[#0a2540] shadow-sm ring-1 ring-slate-200">Export CSV</button>
                        <a href="{{ route('admin.tour-packages.create') }}" class="rounded-lg bg-[#f26419] px-4 py-2.5 text-sm font-bold text-white shadow-sm hover:bg-[#ff7849]">Create Package</a>
                    </div>
                </div>

                <div class="mb-6 grid gap-4 md:grid-cols-4">
                    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-[0_2px_8px_-2px_rgba(10,37,64,0.08)]">
                        <p class="text-xs font-bold uppercase tracking-[0.14em] text-slate-500">Total Packages</p>
                        <p class="font-display mt-2 text-3xl font-extrabold text-[#0a2540]">{{ count($tours) }}</p>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-[0_2px_8px_-2px_rgba(10,37,64,0.08)]">
                        <p class="text-xs font-bold uppercase tracking-[0.14em] text-slate-500">Published</p>
                        <p class="font-display mt-2 text-3xl font-extrabold text-[#006b5f]">24</p>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-[0_2px_8px_-2px_rgba(10,37,64,0.08)]">
                        <p class="text-xs font-bold uppercase tracking-[0.14em] text-slate-500">Drafts</p>
                        <p class="font-display mt-2 text-3xl font-extrabold text-[#f59e0b]">9</p>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-[0_2px_8px_-2px_rgba(10,37,64,0.08)]">
                        <p class="text-xs font-bold uppercase tracking-[0.14em] text-slate-500">Revenue Locked</p>
                        <p class="font-display mt-2 text-3xl font-extrabold text-[#0a2540]">$128k</p>
                    </div>
                </div>

                <div class="mb-6 rounded-2xl border border-slate-200 bg-white p-4 shadow-[0_2px_8px_-2px_rgba(10,37,64,0.08)]">
                    <div class="grid gap-3 md:grid-cols-4">
                        <select id="statusFilter" class="h-11 rounded-xl bg-slate-50 px-3 text-sm font-semibold outline-none">
                            <option value="all">All Statuses</option>
                            <option value="published">Published</option>
                            <option value="draft">Draft</option>
                            <option value="sold out">Sold Out</option>
                        </select>
                        <select id="regionFilter" class="h-11 rounded-xl bg-slate-50 px-3 text-sm font-semibold outline-none">
                            <option value="all">All Regions</option>
                            <option value="asia pacific">Asia Pacific</option>
                            <option value="europe">Europe</option>
                            <option value="africa">Africa</option>
                        </select>
                        <select id="sortFilter" class="h-11 rounded-xl bg-slate-50 px-3 text-sm font-semibold outline-none">
                            <option value="updated">Sort by Last Updated</option>
                            <option value="price">Price: High to Low</option>
                            <option value="seats">Seats Available</option>
                        </select>
                        <button id="applyAdminFilters" type="button" class="rounded-xl bg-[#006b5f] px-4 text-sm font-bold text-white">Apply Filters</button>
                    </div>
                </div>

                <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-[0_12px_24px_-18px_rgba(10,37,64,0.35)]">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
                            <thead class="bg-[#eff4ff] text-xs uppercase tracking-[0.12em] text-slate-500">
                                <tr>
                                    <th class="px-5 py-4"><input id="selectAllCheckbox" type="checkbox"></th>
                                    <th class="px-5 py-4">Package</th>
                                    <th class="px-5 py-4">Destination</th>
                                    <th class="px-5 py-4">Duration</th>
                                    <th class="px-5 py-4">Price</th>
                                    <th class="px-5 py-4">Inventory</th>
                                    <th class="px-5 py-4">Status</th>
                                    <th class="px-5 py-4">Visibility</th>
                                    <th class="px-5 py-4 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100" id="packageRows">
                                @foreach ($tours as $index => $tour)
                                    @php
                                        $statuses = ['Published', 'Published', 'Scheduled', 'Draft', 'Published', 'Sold Out'];
                                        $status = $tour['status'] ?? ($statuses[$index] ?? 'Published');
                                        $visibilityStatus = $tour['visibility_status'] ?? 'Active';
                                        $seats = [8, 12, 5, 10, 14, 0][$index] ?? 6;
                                        $capacity = [12, 16, 8, 14, 18, 8][$index] ?? 12;
                                        $region = str_contains($tour['place'], 'Italy') || str_contains($tour['place'], 'Switzerland') ? 'Europe' : (str_contains($tour['place'], 'Tanzania') ? 'Africa' : 'Asia Pacific');
                                        $priceValue = (int) preg_replace('/[^0-9]/', '', $tour['price']);
                                    @endphp
                                    <tr class="package-row hover:bg-slate-50" data-index="{{ $index }}" data-status="{{ strtolower($status) }}" data-region="{{ strtolower($region) }}" data-price="{{ $priceValue }}" data-seats="{{ $seats }}">
                                        <td class="px-5 py-4"><input type="checkbox" class="row-checkbox"></td>
                                        <td class="px-5 py-4">
                                            <div class="flex items-center gap-3">
                                                <div class="h-14 w-16 rounded-lg bg-[linear-gradient(135deg,#0a2540,#00a896)]"></div>
                                                <div class="min-w-0">
                                                    <a href="{{ route('tour.show', $tour['slug']) }}" class="font-display font-bold text-[#0a2540] hover:text-[#006b5f]">{{ $tour['title'] }}</a>
                                                    <p class="text-xs text-slate-500">#AET-{{ strtoupper(substr($tour['slug'], 0, 3)) }}-{{ $index + 101 }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-5 py-4 font-semibold text-slate-700">{{ $tour['place'] }}</td>
                                        <td class="px-5 py-4 text-slate-600">{{ $tour['duration'] }}</td>
                                        <td class="px-5 py-4 font-bold text-[#0a2540]">{{ $tour['price'] }}</td>
                                        <td class="px-5 py-4">
                                            <div class="min-w-32">
                                                <div class="mb-1 flex justify-between text-xs">
                                                    <span class="font-semibold text-[#0a2540]">{{ $seats }} / {{ $capacity }}</span>
                                                    <span class="text-slate-500">seats</span>
                                                </div>
                                                <div class="h-2 rounded-full bg-slate-100">
                                                    <div class="h-2 rounded-full bg-[#006b5f]" style="width: {{ $capacity ? round(($seats / $capacity) * 100) : 0 }}%"></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-5 py-4">
                                            <span class="rounded-full px-3 py-1 text-xs font-bold {{ $status === 'Published' ? 'bg-[#76f4e0]/30 text-[#006b5f]' : ($status === 'Sold Out' ? 'bg-slate-200 text-slate-600' : 'bg-amber-100 text-amber-700') }}">{{ $status }}</span>
                                        </td>
                                        <td class="px-5 py-4">
                                            <span class="rounded-full px-3 py-1 text-xs font-bold {{ $visibilityStatus === 'Active' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-200 text-slate-600' }}">{{ $visibilityStatus }}</span>
                                        </td>
                                        <td class="px-5 py-4">
                                            <div class="flex justify-end gap-2">
                                                @if ($visibilityStatus === 'Active')
                                                    <a href="{{ route('tour.show', $tour['slug']) }}" class="rounded-lg px-2 py-1 text-xs font-bold text-slate-600 hover:bg-slate-100">Preview</a>
                                                @else
                                                    <span class="rounded-lg px-2 py-1 text-xs font-bold text-slate-400">Hidden</span>
                                                @endif
                                                <a href="{{ route('admin.tour-packages.edit', $tour['slug']) }}" class="rounded-lg px-2 py-1 text-xs font-bold text-[#006b5f] hover:bg-[#76f4e0]/20">Edit</a>
                                                <form method="POST" action="{{ route('admin.tour-packages.visibility', $tour['slug']) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="visibility_status" value="{{ $visibilityStatus === 'Active' ? 'Inactive' : 'Active' }}">
                                                    <button type="submit" class="rounded-lg px-2 py-1 text-xs font-bold {{ $visibilityStatus === 'Active' ? 'text-red-600 hover:bg-red-50' : 'text-emerald-700 hover:bg-emerald-50' }}">
                                                        {{ $visibilityStatus === 'Active' ? 'Set Inactive' : 'Set Active' }}
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="flex flex-col gap-3 border-t border-slate-200 bg-slate-50 px-5 py-4 text-sm text-slate-600 sm:flex-row sm:items-center sm:justify-between">
                        <span>Showing <strong class="text-[#0a2540]">1 - {{ count($tours) }}</strong> of <strong class="text-[#0a2540]">{{ count($tours) }}</strong> packages</span>
                        <span><strong id="selectedCounter">0</strong> selected</span>
                    </div>
                </div>

                <div id="safetyModal" class="hidden fixed inset-0 z-50 bg-[#0a2540]/60 p-4 backdrop-blur-sm">
                    <div class="mx-auto mt-24 max-w-2xl rounded-2xl bg-white p-6 shadow-2xl">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-xs font-bold uppercase tracking-[0.18em] text-red-600">Policy safe-lock</p>
                                <h2 class="font-display mt-2 text-2xl font-extrabold text-[#0a2540]">Confirm Package Archival</h2>
                                <p class="mt-2 text-sm leading-6 text-slate-600">Packages with active bookings should be archived instead of permanently deleted so payment records, vouchers, and customer history remain available.</p>
                            </div>
                            <button onclick="document.getElementById('safetyModal').classList.add('hidden')" class="rounded-lg px-3 py-2 text-slate-500 hover:bg-slate-100">Close</button>
                        </div>
                        <div class="mt-6 flex justify-end gap-3">
                            <button onclick="document.getElementById('safetyModal').classList.add('hidden')" class="rounded-lg border border-slate-200 px-4 py-2 text-sm font-bold text-[#0a2540]">Cancel</button>
                            <button onclick="document.getElementById('safetyModal').classList.add('hidden')" class="rounded-lg bg-[#0a2540] px-4 py-2 text-sm font-bold text-white">Proceed to Archive</button>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <script>
        const selectAll = document.getElementById('selectAllCheckbox');
        const selectedCounter = document.getElementById('selectedCounter');
        const searchInput = document.getElementById('catalogSearchInput');
        const statusFilter = document.getElementById('statusFilter');
        const regionFilter = document.getElementById('regionFilter');
        const sortFilter = document.getElementById('sortFilter');
        const applyAdminFilters = document.getElementById('applyAdminFilters');
        const packageRows = Array.from(document.querySelectorAll('.package-row'));
        const packageRowsBody = document.getElementById('packageRows');

        if (selectAll) {
            selectAll.addEventListener('change', () => {
                const boxes = document.querySelectorAll('.package-row:not(.hidden) .row-checkbox');
                boxes.forEach((box) => box.checked = selectAll.checked);
                selectedCounter.textContent = selectAll.checked ? boxes.length : 0;
            });
        }

        function updateSelectedCounter() {
            selectedCounter.textContent = document.querySelectorAll('.package-row:not(.hidden) .row-checkbox:checked').length;
        }

        function applyAdminPackageFilters() {
            const term = searchInput.value.trim().toLowerCase();
            const selectedStatus = statusFilter.value;
            const selectedRegion = regionFilter.value;

            let visibleRows = packageRows.filter((row) => {
                const matchesSearch = !term || row.innerText.toLowerCase().includes(term);
                const matchesStatus = selectedStatus === 'all' || row.dataset.status === selectedStatus;
                const matchesRegion = selectedRegion === 'all' || row.dataset.region === selectedRegion;

                return matchesSearch && matchesStatus && matchesRegion;
            });

            visibleRows.sort((first, second) => {
                if (sortFilter.value === 'price') {
                    return Number(second.dataset.price) - Number(first.dataset.price);
                }

                if (sortFilter.value === 'seats') {
                    return Number(second.dataset.seats) - Number(first.dataset.seats);
                }

                return Number(first.dataset.index) - Number(second.dataset.index);
            });

            packageRows.forEach((row) => {
                row.classList.add('hidden');
                row.querySelector('.row-checkbox').checked = false;
            });

            visibleRows.forEach((row) => {
                row.classList.remove('hidden');
                packageRowsBody.appendChild(row);
            });

            if (selectAll) {
                selectAll.checked = false;
            }

            updateSelectedCounter();
        }

        if (applyAdminFilters) {
            applyAdminFilters.addEventListener('click', applyAdminPackageFilters);
        }

        if (searchInput) {
            searchInput.addEventListener('input', applyAdminPackageFilters);
        }

        [statusFilter, regionFilter, sortFilter].forEach((filter) => {
            filter?.addEventListener('change', applyAdminPackageFilters);
        });

        document.querySelectorAll('.row-checkbox').forEach((box) => {
            box.addEventListener('change', updateSelectedCounter);
        });
    </script>
</body>
</html>
