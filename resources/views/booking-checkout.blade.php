<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Booking Checkout | {{ $tour['title'] }}</title>

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
                <a href="{{ route('tour-packages') }}" class="font-bold text-[#006b5f]">Tour Packages</a>
                <a href="{{ route('contact') }}" class="hover:text-[#006b5f]">Contact</a>
                <a href="{{ route('client.login') }}" class="hover:text-[#006b5f]">Client Login</a>
            </nav>

            <a href="{{ route('tour.show', $tour['slug']) }}" class="rounded-md border border-slate-200 px-4 py-2.5 text-sm font-bold text-[#0a2540] transition hover:bg-slate-50">
                Back to Tour
            </a>
        </div>
    </header>

    <main>
        <section class="border-b border-slate-200 bg-white">
            <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
                <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.22em] text-[#006b5f]">Secure checkout</p>
                        <h1 class="font-display mt-2 text-3xl font-extrabold text-[#0a2540] sm:text-4xl">Book {{ $tour['title'] }}</h1>
                        <p class="mt-2 text-sm text-slate-600">Review traveler details, confirm dates, and secure your booking deposit.</p>
                    </div>
                    <div class="flex items-center gap-2 rounded-full bg-[#76f4e0]/25 px-4 py-2 text-sm font-bold text-[#006b5f]">
                        <span class="h-2 w-2 rounded-full bg-[#006b5f]"></span>
                        Inventory reserved for 15 minutes
                    </div>
                </div>

                <div class="mt-8 grid min-w-0 gap-3 text-center text-xs font-bold text-slate-500 sm:grid-cols-4">
                    <div class="rounded-xl bg-[#006b5f] px-3 py-3 text-white">1. Tour Selected</div>
                    <div class="rounded-xl bg-[#006b5f] px-3 py-3 text-white">2. Traveler Info</div>
                    <div class="rounded-xl bg-[#0a2540] px-3 py-3 text-white">3. Payment</div>
                    <div class="rounded-xl bg-slate-100 px-3 py-3">4. Confirmation</div>
                </div>
            </div>
        </section>

        <form method="POST" action="{{ route('booking.store', $tour['slug']) }}" class="mx-auto grid max-w-7xl gap-8 px-4 py-10 sm:px-6 lg:grid-cols-[1fr_420px] lg:px-8">
            @csrf
            <div class="space-y-6">
                @if ($errors->any())
                    <div class="rounded-2xl border border-red-200 bg-red-50 p-5 text-sm font-bold text-red-700">
                        Please complete the guest information before confirming the booking.
                    </div>
                @endif

                <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_2px_8px_-2px_rgba(10,37,64,0.08)]">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h2 class="font-display text-2xl font-extrabold text-[#0a2540]">Lead traveler details</h2>
                            <p class="mt-1 text-sm text-slate-600">Primary booking contact for confirmations and travel documents.</p>
                        </div>
                        <span class="rounded-full bg-[#76f4e0]/30 px-3 py-1 text-xs font-bold text-[#006b5f]">Required</span>
                    </div>

                    <div class="mt-6 grid gap-5">
                        <div class="grid gap-5 md:grid-cols-2">
                            <label class="block">
                                <span class="text-sm font-bold text-[#0a2540]">Full legal name</span>
                                <input name="guest_name" type="text" value="{{ old('guest_name') }}" placeholder="Juan Dela Cruz" class="mt-2 h-12 w-full rounded-xl border border-slate-200 px-4 text-sm outline-none focus:border-[#00a896] focus:ring-4 focus:ring-[#00a896]/15" required>
                            </label>
                            <label class="block">
                                <span class="text-sm font-bold text-[#0a2540]">Email address</span>
                                <input name="guest_email" type="email" value="{{ old('guest_email') }}" placeholder="guest@example.com" class="mt-2 h-12 w-full rounded-xl border border-slate-200 px-4 text-sm outline-none focus:border-[#00a896] focus:ring-4 focus:ring-[#00a896]/15" required>
                            </label>
                            <label class="block">
                                <span class="text-sm font-bold text-[#0a2540]">Phone number</span>
                                <input name="guest_phone" type="tel" value="{{ old('guest_phone') }}" placeholder="+63 912 345 6789" class="mt-2 h-12 w-full rounded-xl border border-slate-200 px-4 text-sm outline-none focus:border-[#00a896] focus:ring-4 focus:ring-[#00a896]/15" required>
                            </label>
                            <label class="block">
                                <span class="text-sm font-bold text-[#0a2540]">Nationality</span>
                                <input name="guest_nationality" type="text" value="{{ old('guest_nationality') }}" placeholder="Philippines" class="mt-2 h-12 w-full rounded-xl border border-slate-200 px-4 text-sm outline-none focus:border-[#00a896] focus:ring-4 focus:ring-[#00a896]/15" required>
                            </label>
                        </div>
                    </div>
                </section>

                <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_2px_8px_-2px_rgba(10,37,64,0.08)]">
                    <h2 class="font-display text-2xl font-extrabold text-[#0a2540]">Payment method</h2>
                    <p class="mt-1 text-sm text-slate-600">Choose how you want to settle the booking deposit.</p>

                    <div class="mt-5 grid gap-3 md:grid-cols-3">
                        <label class="payment-option cursor-pointer rounded-xl border-2 border-[#00a896] bg-[#76f4e0]/15 p-4 transition" data-payment-option="credit-card">
                            <input type="radio" name="payment_method" value="credit-card" class="sr-only" checked>
                            <span class="block text-sm font-bold text-[#0a2540]">Credit Card</span>
                            <span class="mt-1 block text-xs leading-5 text-slate-500">Visa, Mastercard, AMEX</span>
                        </label>
                        <label class="payment-option cursor-pointer rounded-xl border-2 border-slate-200 bg-white p-4 transition hover:border-[#00a896]/40" data-payment-option="gcash">
                            <input type="radio" name="payment_method" value="gcash" class="sr-only">
                            <span class="block text-sm font-bold text-[#0a2540]">GCash</span>
                            <span class="mt-1 block text-xs leading-5 text-slate-500">Mobile wallet payment</span>
                        </label>
                        <label class="payment-option cursor-pointer rounded-xl border-2 border-slate-200 bg-white p-4 transition hover:border-[#00a896]/40" data-payment-option="arrival">
                            <input type="radio" name="payment_method" value="arrival" class="sr-only">
                            <span class="block text-sm font-bold text-[#0a2540]">Upon Arrival</span>
                            <span class="mt-1 block text-xs leading-5 text-slate-500">Pay at travel desk</span>
                        </label>
                    </div>

                    <div id="credit-card-fields" class="payment-panel mt-5 grid gap-4 md:grid-cols-2">
                        <label class="block md:col-span-2">
                            <span class="text-sm font-bold text-[#0a2540]">Card number</span>
                            <input type="text" placeholder="4242 4242 4242 4242" class="mt-2 h-12 w-full rounded-xl border border-slate-200 px-4 text-sm outline-none focus:border-[#00a896] focus:ring-4 focus:ring-[#00a896]/15">
                        </label>
                        <label class="block">
                            <span class="text-sm font-bold text-[#0a2540]">Expiry</span>
                            <input type="text" placeholder="MM / YY" class="mt-2 h-12 w-full rounded-xl border border-slate-200 px-4 text-sm outline-none focus:border-[#00a896] focus:ring-4 focus:ring-[#00a896]/15">
                        </label>
                        <label class="block">
                            <span class="text-sm font-bold text-[#0a2540]">CVC</span>
                            <input type="text" placeholder="123" class="mt-2 h-12 w-full rounded-xl border border-slate-200 px-4 text-sm outline-none focus:border-[#00a896] focus:ring-4 focus:ring-[#00a896]/15">
                        </label>
                    </div>

                    <div id="gcash-fields" class="payment-panel mt-5 hidden rounded-xl border border-slate-200 bg-[#f8f9ff] p-5">
                        <label class="block">
                            <span class="text-sm font-bold text-[#0a2540]">GCash mobile number</span>
                            <input type="tel" placeholder="09XX XXX XXXX" class="mt-2 h-12 w-full rounded-xl border border-slate-200 px-4 text-sm outline-none focus:border-[#00a896] focus:ring-4 focus:ring-[#00a896]/15">
                        </label>
                        <p class="mt-3 text-sm leading-6 text-slate-600">A GCash payment request or QR instruction can be sent after confirming the booking.</p>
                    </div>

                    <div id="arrival-fields" class="payment-panel mt-5 hidden rounded-xl border border-slate-200 bg-[#f8f9ff] p-5">
                        <p class="text-sm font-bold text-[#0a2540]">Pay upon arrival selected</p>
                        <p class="mt-2 text-sm leading-6 text-slate-600">Your slot will be marked as pending. The guest pays at the travel desk or to the assigned coordinator before the tour starts.</p>
                        <label class="mt-4 flex items-start gap-3 text-sm text-slate-600">
                            <input type="checkbox" class="mt-1 rounded border-slate-300 text-[#006b5f]">
                            <span>I understand this booking is not fully paid until arrival payment is completed.</span>
                        </label>
                    </div>
                    <button type="submit" class="mt-6 w-full rounded-md bg-[#f26419] px-5 py-3 text-sm font-bold text-white transition hover:bg-[#ff7849]">
                        Confirm Booking
                    </button>
                </section>
            </div>

            <aside class="h-fit rounded-2xl border border-slate-200 bg-white shadow-[0_12px_24px_-18px_rgba(10,37,64,0.35)] lg:sticky lg:top-24">
                <div class="rounded-t-2xl bg-[linear-gradient(135deg,#0a2540,#00a896)] p-5 text-white">
                    <span class="rounded-full bg-white/15 px-3 py-1 text-xs font-bold">{{ $tour['style'] }}</span>
                    <h2 class="font-display mt-16 text-2xl font-extrabold">{{ $tour['title'] }}</h2>
                    <p class="mt-1 text-sm text-[#d5e3fc]">{{ $tour['place'] }}</p>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 gap-3 text-sm">
                        <div class="rounded-xl bg-slate-50 p-3">
                            <span class="block text-xs font-bold uppercase text-slate-500">Duration</span>
                            <strong class="text-[#0a2540]">{{ $tour['duration'] }}</strong>
                        </div>
                        <div class="rounded-xl bg-slate-50 p-3">
                            <span class="block text-xs font-bold uppercase text-slate-500">Guests</span>
                            <strong class="text-[#0a2540]">2 Adults</strong>
                        </div>
                    </div>

                    <div class="mt-6 space-y-3 text-sm text-slate-600">
                        <div class="flex justify-between"><span>Base tour price</span><strong class="text-[#0a2540]">{{ $tour['price'] }}</strong></div>
                        <div class="flex justify-between"><span>Service and sanctuary fees</span><strong class="text-[#0a2540]">$80</strong></div>
                        <div class="flex justify-between text-[#006b5f]"><span>Early booking discount</span><strong>-$120</strong></div>
                    </div>

                    <div class="mt-5 border-t border-slate-200 pt-5">
                        <div class="flex items-end justify-between">
                            <span class="font-display text-xl font-extrabold text-[#0a2540]">Total</span>
                            <span class="font-display text-3xl font-extrabold text-[#0a2540]">{{ $tour['price'] }}</span>
                        </div>
                        <div class="mt-4 rounded-xl bg-[#f8f9ff] p-4">
                            <div class="flex justify-between">
                                <span class="text-sm font-bold text-[#0a2540]">Due today deposit</span>
                                <span class="font-display text-xl font-extrabold text-[#f26419]">20%</span>
                            </div>
                            <p class="mt-1 text-xs leading-5 text-slate-500">Remaining balance can be settled before departure. This is a checkout prototype and payment gateway integration comes next.</p>
                        </div>
                    </div>
                </div>
            </aside>
        </form>
    </main>
    <script>
        document.querySelectorAll('.payment-option').forEach((option) => {
            option.addEventListener('click', () => {
                const selected = option.dataset.paymentOption;

                document.querySelectorAll('.payment-option').forEach((item) => {
                    item.classList.remove('border-[#00a896]', 'bg-[#76f4e0]/15');
                    item.classList.add('border-slate-200', 'bg-white');
                    item.querySelector('input').checked = false;
                });

                option.classList.add('border-[#00a896]', 'bg-[#76f4e0]/15');
                option.classList.remove('border-slate-200', 'bg-white');
                option.querySelector('input').checked = true;

                document.querySelectorAll('.payment-panel').forEach((panel) => {
                    panel.classList.add('hidden');
                });

                document.getElementById(`${selected}-fields`).classList.remove('hidden');
            });
        });
    </script>
</body>
</html>
