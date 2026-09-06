<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact | {{ config('app.name', 'Aethereal Luxury Travel') }}</title>

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
                <a href="{{ route('tour-packages') }}" class="hover:text-[#006b5f]">Tour Packages</a>
                <a href="{{ route('contact') }}" aria-current="page" class="border-b-2 border-[#006b5f] pb-1 font-bold text-[#006b5f]">Contact</a>
                <a href="{{ route('client.login') }}" class="hover:text-[#006b5f]">Client Login</a>
            </nav>

            <a href="tel:+18002228687" class="rounded-md bg-[#f26419] px-4 py-2.5 text-sm font-bold text-white transition hover:bg-[#ff7849]">
                Call Us
            </a>
        </div>
    </header>

    <main>
        <section class="bg-[#0a2540] text-white">
            <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
                <nav class="mb-6 flex items-center gap-2 text-sm text-[#b0c8eb]">
                    <a href="{{ route('home') }}" class="font-semibold text-[#76f4e0]">Home</a>
                    <span>/</span>
                    <span>Contact</span>
                </nav>

                <p class="text-xs font-bold uppercase tracking-[0.22em] text-[#76f4e0]">Talk to a travel specialist</p>
                <h1 class="font-display mt-4 max-w-4xl text-4xl font-extrabold leading-tight sm:text-5xl">Let us shape your next journey with care.</h1>
                <p class="mt-5 max-w-3xl text-base leading-7 text-[#d5e3fc]">Send an inquiry for private trips, group bookings, custom dates, or destination advice. This page is ready to connect to email or database storage next.</p>
            </div>
        </section>

        <section class="mx-auto grid max-w-7xl gap-8 px-4 py-16 sm:px-6 lg:grid-cols-[1fr_380px] lg:px-8">
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_12px_24px_-18px_rgba(10,37,64,0.35)] sm:p-8">
                <h2 class="font-display text-2xl font-extrabold text-[#0a2540]">Send an inquiry</h2>
                <form class="mt-6 grid gap-5" method="POST" action="{{ route('generate') }}">
                    @csrf
                    <input type="hidden" name="business_type" value="Contact inquiry">

                    <div class="grid gap-5 md:grid-cols-2">
                        <label class="block">
                            <span class="text-sm font-bold text-[#0a2540]">Full name</span>
                            <input type="text" name="name" placeholder="Your name" class="mt-2 h-12 w-full rounded-xl border border-slate-200 px-4 text-sm outline-none focus:border-[#00a896] focus:ring-4 focus:ring-[#00a896]/15">
                        </label>
                        <label class="block">
                            <span class="text-sm font-bold text-[#0a2540]">Email address</span>
                            <input type="email" name="email" placeholder="you@example.com" class="mt-2 h-12 w-full rounded-xl border border-slate-200 px-4 text-sm outline-none focus:border-[#00a896] focus:ring-4 focus:ring-[#00a896]/15">
                        </label>
                    </div>

                    <label class="block">
                        <span class="text-sm font-bold text-[#0a2540]">Trip interest</span>
                        <select name="interest" class="mt-2 h-12 w-full rounded-xl border border-slate-200 bg-white px-4 text-sm outline-none focus:border-[#00a896] focus:ring-4 focus:ring-[#00a896]/15">
                            <option>Private luxury tour</option>
                            <option>Family vacation</option>
                            <option>Corporate or group travel</option>
                            <option>Custom honeymoon</option>
                        </select>
                    </label>

                    <label class="block">
                        <span class="text-sm font-bold text-[#0a2540]">Message</span>
                        <textarea name="message" rows="6" placeholder="Tell us where you want to go, travel dates, group size, and preferred budget." class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-[#00a896] focus:ring-4 focus:ring-[#00a896]/15"></textarea>
                    </label>

                    <button type="submit" class="w-fit rounded-md bg-[#f26419] px-6 py-3 text-sm font-bold text-white transition hover:bg-[#ff7849]">
                        Send Inquiry
                    </button>
                </form>
            </div>

            <aside class="space-y-5">
                <div class="rounded-2xl bg-[#0a2540] p-6 text-white">
                    <h2 class="font-display text-2xl font-extrabold">Contact details</h2>
                    <div class="mt-5 space-y-4 text-sm text-[#d5e3fc]">
                        <p><strong class="block text-white">24/7 Concierge</strong> +1 (800) 222-TOUR</p>
                        <p><strong class="block text-white">Email</strong> hello@aetherealtravel.com</p>
                        <p><strong class="block text-white">Office Hours</strong> Monday to Saturday, 9:00 AM - 6:00 PM</p>
                    </div>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-6">
                    <h3 class="font-display text-xl font-bold text-[#0a2540]">Fast planning tips</h3>
                    <ul class="mt-4 space-y-3 text-sm leading-6 text-slate-600">
                        <li>Share your destination shortlist.</li>
                        <li>Include travel dates and group size.</li>
                        <li>Mention budget range and preferred hotel style.</li>
                    </ul>
                </div>
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
