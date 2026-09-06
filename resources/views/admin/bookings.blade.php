<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Booking Management | {{ config('app.name', 'Aethereal Luxury Travel') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
</head>
<body class="bg-[#f8f9ff] text-[#0d1c2e] antialiased">
    @php
        $bookingCollection = collect($bookings);
        $confirmedCount = $bookingCollection->where('booking_status', 'Confirmed')->count();
        $pendingPaymentCount = $bookingCollection->filter(fn ($booking) => str_contains(strtolower($booking['payment_status'] ?? ''), 'pending'))->count();
        $arrivalPaymentCount = $bookingCollection->where('payment_method', 'arrival')->count();
    @endphp

    <div class="min-h-screen lg:grid lg:grid-cols-[280px_1fr]">
        <aside class="flex flex-col border-r border-slate-200 bg-white p-5 lg:min-h-screen">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <img src="{{ asset('assets/images/abc_travel_agency_logo.png') }}" alt="Aethereal Luxury Travel logo" class="h-14 w-36 rounded-lg object-contain">
            </a>
            <nav class="mt-8 space-y-6 text-sm">
                <div>
                    <p class="mb-2 px-3 text-xs font-bold uppercase tracking-[0.18em] text-slate-400">Overview</p>
                    <a href="{{ route('home') }}" class="flex rounded-lg px-3 py-2 font-semibold text-slate-600 hover:bg-slate-50">Home</a>
                    <a href="{{ route('tour-packages') }}" class="mt-1 flex rounded-lg px-3 py-2 font-semibold text-slate-600 hover:bg-slate-50">Public Tour Packages</a>
                    <a href="{{ route('destinations') }}" class="mt-1 flex rounded-lg px-3 py-2 font-semibold text-slate-600 hover:bg-slate-50">Destinations</a>
                </div>
                <div>
                    <p class="mb-2 px-3 text-xs font-bold uppercase tracking-[0.18em] text-slate-400">Operations</p>
                    <a href="{{ route('admin.tour-packages') }}" class="flex rounded-lg px-3 py-2 font-semibold text-slate-600 hover:bg-slate-50">Tour Packages</a>
                    <a href="{{ route('admin.bookings') }}" aria-current="page" class="mt-1 flex rounded-lg bg-[#d5e3fc] px-3 py-2 font-bold text-[#0a2540]">Bookings</a>
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

        <main class="px-4 py-8 sm:px-6 lg:px-8">
            <div class="mb-8 flex flex-col justify-between gap-4 lg:flex-row lg:items-end">
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.22em] text-[#006b5f]">Admin dashboard</p>
                    <h1 class="font-display mt-2 text-4xl font-extrabold text-[#0a2540]">Booking Management</h1>
                    <p class="mt-2 max-w-3xl text-sm leading-6 text-slate-600">Review all client bookings, trip details, payment notes, and booking statuses.</p>
                </div>
                <a href="{{ route('admin.tour-packages') }}" class="inline-flex justify-center rounded-lg bg-[#0a2540] px-5 py-3 text-sm font-bold text-white hover:bg-[#143b5d]">Back to Dashboard</a>
            </div>

            <section class="grid gap-4 md:grid-cols-4">
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-[0_12px_24px_-18px_rgba(10,37,64,0.35)]">
                    <p class="text-sm font-bold text-slate-500">Total Bookings</p>
                    <p class="font-display mt-2 text-3xl font-extrabold text-[#0a2540]">{{ count($bookings) }}</p>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-[0_12px_24px_-18px_rgba(10,37,64,0.35)]">
                    <p class="text-sm font-bold text-slate-500">Confirmed</p>
                    <p class="font-display mt-2 text-3xl font-extrabold text-[#0a2540]">{{ $confirmedCount }}</p>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-[0_12px_24px_-18px_rgba(10,37,64,0.35)]">
                    <p class="text-sm font-bold text-slate-500">Pending Payment</p>
                    <p class="font-display mt-2 text-3xl font-extrabold text-[#0a2540]">{{ $pendingPaymentCount }}</p>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-[0_12px_24px_-18px_rgba(10,37,64,0.35)]">
                    <p class="text-sm font-bold text-slate-500">Upon Arrival</p>
                    <p class="font-display mt-2 text-3xl font-extrabold text-[#0a2540]">{{ $arrivalPaymentCount }}</p>
                </div>
            </section>

            <section class="mt-8 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-[0_12px_24px_-18px_rgba(10,37,64,0.35)]">
                <div class="border-b border-slate-200 px-5 py-5">
                    <h2 class="font-display text-2xl font-extrabold text-[#0a2540]">All Client Bookings</h2>
                    <p class="mt-1 text-sm text-slate-500">Use this list to check references, guest details, payment status, and trip status.</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
                        <thead class="bg-[#eff4ff] text-xs uppercase tracking-[0.12em] text-slate-500">
                            <tr>
                                <th class="px-5 py-4">Reference</th>
                                <th class="px-5 py-4">Client</th>
                                <th class="px-5 py-4">Package</th>
                                <th class="px-5 py-4">Travel Details</th>
                                <th class="px-5 py-4">Payment</th>
                                <th class="px-5 py-4">Status</th>
                                <th class="px-5 py-4">Date</th>
                                <th class="px-5 py-4">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse ($bookings as $booking)
                                @php
                                    $paymentMethod = ucwords(str_replace('-', ' ', $booking['payment_method'] ?? 'Not selected'));
                                    $paymentStatus = $booking['payment_status'] ?? 'Pending';
                                    $bookingStatus = $booking['booking_status'] ?? 'Pending';
                                @endphp
                                <tr class="align-top hover:bg-slate-50">
                                    <td class="px-5 py-4">
                                        <a href="{{ route('booking.details', $booking['reference']) }}" class="font-bold text-[#006b5f]">{{ $booking['reference'] }}</a>
                                    </td>
                                    <td class="px-5 py-4">
                                        <p class="font-display font-bold text-[#0a2540]">{{ $booking['guest_name'] ?? 'Guest' }}</p>
                                        <p class="mt-1 text-xs text-slate-500">{{ $booking['guest_email'] ?? 'No email' }}</p>
                                        <p class="text-xs text-slate-500">{{ $booking['guest_phone'] ?? 'No phone' }}</p>
                                        <p class="text-xs text-slate-500">{{ $booking['guest_nationality'] ?? 'Nationality not set' }}</p>
                                    </td>
                                    <td class="px-5 py-4">
                                        <p class="font-bold text-[#0a2540]">{{ $booking['tour_title'] ?? 'Tour package' }}</p>
                                        <p class="text-xs text-slate-500">{{ $booking['tour_place'] ?? 'Destination not set' }}</p>
                                    </td>
                                    <td class="px-5 py-4">
                                        <p class="font-semibold text-[#0a2540]">{{ $booking['tour_duration'] ?? 'Duration not set' }}</p>
                                        <p class="text-xs text-slate-500">${{ number_format((float) ($booking['tour_price'] ?? 0)) }} per guest</p>
                                    </td>
                                    <td class="px-5 py-4">
                                        <p class="font-bold text-[#0a2540]">{{ $paymentMethod }}</p>
                                        <span class="mt-2 inline-flex rounded-full bg-[#fff3e8] px-3 py-1 text-xs font-bold text-[#b9470c]">{{ $paymentStatus }}</span>
                                    </td>
                                    <td class="px-5 py-4">
                                        <span class="inline-flex rounded-full bg-[#76f4e0]/30 px-3 py-1 text-xs font-bold text-[#006b5f]">{{ $bookingStatus }}</span>
                                    </td>
                                    <td class="px-5 py-4 text-xs text-slate-500">{{ $booking['created_at'] ?? 'Not recorded' }}</td>
                                    <td class="px-5 py-4">
                                        <a href="{{ route('booking.details', $booking['reference']) }}" class="inline-flex rounded-lg border border-slate-200 px-3 py-2 text-xs font-bold text-[#0a2540] hover:bg-slate-50">View Details</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-5 py-12 text-center">
                                        <p class="font-display text-xl font-bold text-[#0a2540]">No bookings yet.</p>
                                        <p class="mt-2 text-sm text-slate-500">Confirmed client bookings will appear here after checkout.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
