<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('home');
    }

    public function tourPackages(): View
    {
        return view('tour-packages', [
            'tours' => $this->activeTourPackagesData(),
        ]);
    }

    public function tourDetail(string $slug): View
    {
        $tour = collect($this->activeTourPackagesData())->firstWhere('slug', $slug);

        abort_if(! $tour, 404);

        return view('tour-detail', ['tour' => $tour]);
    }

    public function booking(string $slug): View
    {
        $tour = collect($this->activeTourPackagesData())->firstWhere('slug', $slug);

        abort_if(! $tour, 404);

        return view('booking-checkout', ['tour' => $tour]);
    }

    public function storeBooking(Request $request, string $slug): RedirectResponse
    {
        $tour = collect($this->activeTourPackagesData())->firstWhere('slug', $slug);

        abort_if(! $tour, 404);

        $data = $request->validate([
            'guest_name' => ['required', 'string', 'max:120'],
            'guest_email' => ['required', 'email', 'max:160'],
            'guest_phone' => ['required', 'string', 'max:60'],
            'guest_nationality' => ['required', 'string', 'max:80'],
            'payment_method' => ['required', 'in:credit-card,gcash,arrival'],
        ]);

        $reference = 'AET-' . strtoupper(Str::random(6));
        $booking = [
            'reference' => $reference,
            'tour_slug' => $tour['slug'],
            'tour_title' => $tour['title'],
            'tour_place' => $tour['place'],
            'tour_duration' => $tour['duration'],
            'tour_price' => $tour['price'],
            'guest_name' => $data['guest_name'],
            'guest_email' => $data['guest_email'],
            'guest_phone' => $data['guest_phone'],
            'guest_nationality' => $data['guest_nationality'],
            'payment_method' => $data['payment_method'],
            'payment_status' => $data['payment_method'] === 'arrival' ? 'Pending upon arrival' : 'Deposit pending',
            'booking_status' => 'Confirmed',
            'created_at' => now()->toDateTimeString(),
        ];

        $bookings = $this->bookingsData();
        $bookings[] = $booking;
        $this->saveBookingsData($bookings);

        return redirect()->route('booking.details', $reference);
    }

    public function bookingDetails(string $reference): View
    {
        $booking = collect($this->bookingsData())->firstWhere('reference', $reference);

        abort_if(! $booking, 404);

        return view('booking-details', ['booking' => $booking]);
    }

    public function destinations(): View
    {
        return view('destinations', [
            'destinations' => $this->destinationsData(),
        ]);
    }

    public function contact(): View
    {
        return view('contact');
    }

    public function clientLogin(): View
    {
        return view('client-login');
    }

    public function clientDashboard(): View
    {
        return view('client-dashboard', [
            'bookings' => array_reverse($this->bookingsData()),
        ]);
    }

    public function adminLogin(): View
    {
        return view('admin.login');
    }

    public function adminAuthenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (
            hash_equals((string) env('ADMIN_EMAIL'), $credentials['email'])
            && hash_equals((string) env('ADMIN_PASSWORD'), $credentials['password'])
        ) {
            $request->session()->regenerate();
            $request->session()->put('admin_authenticated', true);
            $request->session()->put('admin_email', $credentials['email']);

            return redirect()->route('admin.tour-packages');
        }

        return back()
            ->withErrors(['email' => 'Invalid admin email or password.'])
            ->onlyInput('email');
    }

    public function adminLogout(Request $request): RedirectResponse
    {
        $request->session()->forget(['admin_authenticated', 'admin_email']);
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    public function clients(): View
    {
        $this->requireAdminLogin();

        return view('admin.clients', [
            'bookings' => array_reverse($this->bookingsData()),
        ]);
    }

    public function bookings(): View
    {
        $this->requireAdminLogin();

        return view('admin.bookings', [
            'bookings' => array_reverse($this->bookingsData()),
        ]);
    }

    public function tourPackageManagement(): View
    {
        $this->requireAdminLogin();

        return view('admin.tour-package-management', [
            'tours' => $this->tourPackagesData(),
        ]);
    }

    public function createTourPackage(): View
    {
        $this->requireAdminLogin();

        return view('admin.tour-package-builder', [
            'mode' => 'create',
            'tour' => null,
        ]);
    }

    public function editTourPackage(string $slug): View
    {
        $this->requireAdminLogin();

        $tour = collect($this->tourPackagesData())->firstWhere('slug', $slug);

        abort_if(! $tour, 404);

        return view('admin.tour-package-builder', [
            'mode' => 'edit',
            'tour' => $tour,
        ]);
    }

    public function storeTourPackage(Request $request): RedirectResponse
    {
        $this->requireAdminLogin();

        $tour = $this->validatedTourPackage($request);
        $tour['slug'] = $this->uniqueTourSlug($tour['title']);
        $tour['rating'] = 'New';

        $customTours = $this->customTourPackagesData();
        $customTours[] = $tour;
        $this->saveCustomTourPackagesData($customTours);

        return redirect()
            ->route('admin.tour-packages')
            ->with('status', 'Package created successfully.');
    }

    public function updateTourPackage(Request $request, string $slug): RedirectResponse
    {
        $this->requireAdminLogin();

        $tour = $this->validatedTourPackage($request);
        $tour['slug'] = $slug;
        $tour['rating'] = 'Updated';

        $customTours = $this->customTourPackagesData();
        $updated = false;

        foreach ($customTours as $index => $customTour) {
            if (($customTour['slug'] ?? '') === $slug) {
                $customTours[$index] = $tour;
                $updated = true;
                break;
            }
        }

        if (! $updated) {
            $customTours[] = $tour;
        }

        $this->saveCustomTourPackagesData($customTours);

        return redirect()
            ->route('admin.tour-packages')
            ->with('status', 'Package updated successfully.');
    }

    public function updateTourPackageVisibility(Request $request, string $slug): RedirectResponse
    {
        $this->requireAdminLogin();

        $data = $request->validate([
            'visibility_status' => ['required', 'in:Active,Inactive'],
        ]);

        $tour = collect($this->tourPackagesData())->firstWhere('slug', $slug);

        abort_if(! $tour, 404);

        $tour['visibility_status'] = $data['visibility_status'];

        $customTours = $this->customTourPackagesData();
        $updated = false;

        foreach ($customTours as $index => $customTour) {
            if (($customTour['slug'] ?? '') === $slug) {
                $customTours[$index] = array_merge($customTour, $tour);
                $updated = true;
                break;
            }
        }

        if (! $updated) {
            $customTours[] = $tour;
        }

        $this->saveCustomTourPackagesData($customTours);

        return redirect()
            ->route('admin.tour-packages')
            ->with('status', 'Package marked ' . strtolower($data['visibility_status']) . '.');
    }

    public function generate(Request $request): string
    {
        $request->validate([
            'business_type' => ['required', 'string', 'max:255'],
        ]);

        return 'Generated successfully';
    }

    private function tourPackagesData(): array
    {
        $baseTours = [
            [
                'slug' => 'palawan-private-lagoon-escape',
                'title' => 'Palawan Private Lagoon Escape',
                'place' => 'El Nido, Philippines',
                'duration' => '5 Days / 4 Nights',
                'price' => '$1,240',
                'style' => 'Island Escape',
                'rating' => '4.98',
                'status' => 'Published',
                'visibility_status' => 'Active',
                'description' => 'Private boat days through turquoise lagoons, limestone cliffs, reef-safe snorkeling, and boutique island stays.',
            ],
            [
                'slug' => 'kyoto-heritage-ryokan-trail',
                'title' => 'Kyoto Heritage & Ryokan Trail',
                'place' => 'Kyoto, Japan',
                'duration' => '7 Days / 6 Nights',
                'price' => '$2,180',
                'style' => 'Culture',
                'rating' => '4.96',
                'status' => 'Published',
                'visibility_status' => 'Active',
                'description' => 'Temple walks, tea ceremonies, kaiseki dining, garden mornings, and a restful ryokan stay.',
            ],
            [
                'slug' => 'amalfi-coast-private-cruise',
                'title' => 'Amalfi Coast Private Cruise',
                'place' => 'Amalfi, Italy',
                'duration' => '6 Days / 5 Nights',
                'price' => '$2,950',
                'style' => 'Luxury Cruise',
                'rating' => '4.94',
                'status' => 'Scheduled',
                'visibility_status' => 'Active',
                'description' => 'Private skipper routes through hidden coves, cliffside villages, sunset dining, and boutique coastal hotels.',
            ],
            [
                'slug' => 'swiss-alpine-rail-journey',
                'title' => 'Swiss Alpine Rail Journey',
                'place' => 'Lucerne, Switzerland',
                'duration' => '8 Days / 7 Nights',
                'price' => '$3,120',
                'style' => 'Scenic Rail',
                'rating' => '4.92',
                'status' => 'Draft',
                'visibility_status' => 'Active',
                'description' => 'Panoramic rail routes, alpine lake villages, mountain passes, and luxury lodge evenings.',
            ],
            [
                'slug' => 'bali-wellness-retreat',
                'title' => 'Bali Wellness Retreat',
                'place' => 'Ubud, Indonesia',
                'duration' => '4 Days / 3 Nights',
                'price' => '$980',
                'style' => 'Wellness',
                'rating' => '4.91',
                'status' => 'Published',
                'visibility_status' => 'Active',
                'description' => 'Rice terrace stays, guided wellness rituals, temple visits, spa sessions, and slow mornings.',
            ],
            [
                'slug' => 'serengeti-migration-safari',
                'title' => 'Serengeti Migration Safari',
                'place' => 'Tanzania',
                'duration' => '8 Days / 7 Nights',
                'price' => '$3,450',
                'style' => 'Wildlife',
                'rating' => '4.99',
                'status' => 'Sold Out',
                'visibility_status' => 'Active',
                'description' => 'Open-top safari drives, migration viewing, private guides, lodge stays, and golden-hour wildlife tracking.',
            ],
        ];

        return collect($baseTours)
            ->merge($this->customTourPackagesData())
            ->keyBy('slug')
            ->values()
            ->all();
    }

    private function requireAdminLogin(): void
    {
        if (! session('admin_authenticated')) {
            redirect()->route('admin.login')->send();
            exit;
        }
    }

    private function activeTourPackagesData(): array
    {
        return collect($this->tourPackagesData())
            ->filter(fn (array $tour) => ($tour['visibility_status'] ?? 'Active') === 'Active')
            ->values()
            ->all();
    }

    private function destinationsData(): array
    {
        return collect($this->activeTourPackagesData())
            ->groupBy(fn (array $tour) => $this->destinationName($tour['place']))
            ->map(function ($tours, string $name) {
                $firstTour = $tours->first();
                $country = $this->destinationCountry($firstTour['place']);

                return [
                    'name' => $name,
                    'country' => $country,
                    'region' => $this->tourRegion($firstTour['place']),
                    'description' => $firstTour['description'],
                    'tag' => 'Best for ' . strtolower($firstTour['style']),
                    'count' => $tours->count() . ' ' . Str::plural('package', $tours->count()),
                    'packages' => $tours
                        ->map(fn (array $tour) => [
                            'slug' => $tour['slug'],
                            'title' => $tour['title'],
                            'price' => $tour['price'],
                        ])
                        ->values()
                        ->all(),
                ];
            })
            ->values()
            ->all();
    }

    private function destinationName(string $place): string
    {
        $placeLower = Str::lower($place);

        if ($this->tourRegion($place) === 'philippines') {
            if (Str::contains($placeLower, ['palawan', 'el nido', 'coron'])) {
                return 'Palawan';
            }

            if (Str::contains($placeLower, 'boracay')) {
                return 'Boracay';
            }

            if (Str::contains($placeLower, 'cebu')) {
                return 'Cebu';
            }
        }

        $parts = array_map('trim', explode(',', $place));

        if (count($parts) >= 2 && $this->tourRegion($place) === 'philippines') {
            return $parts[1];
        }

        return $parts[0] ?? $place;
    }

    private function destinationCountry(string $place): string
    {
        if ($this->tourRegion($place) === 'philippines') {
            return 'Philippines';
        }

        $parts = array_map('trim', explode(',', $place));

        return count($parts) > 1 ? end($parts) : $place;
    }

    private function tourRegion(string $place): string
    {
        $place = Str::lower($place);
        $philippinePlaces = ['philippines', 'palawan', 'el nido', 'boracay', 'cebu', 'bohol', 'siargao', 'coron', 'manila'];

        if (Str::contains($place, $philippinePlaces)) {
            return 'philippines';
        }

        if (Str::contains($place, ['italy', 'switzerland'])) {
            return 'europe';
        }

        if (Str::contains($place, ['tanzania', 'africa'])) {
            return 'africa';
        }

        return 'asia';
    }

    private function validatedTourPackage(Request $request): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:120'],
            'place' => ['required', 'string', 'max:120'],
            'style' => ['required', 'string', 'max:80'],
            'description' => ['required', 'string', 'max:800'],
            'price' => ['required', 'string', 'max:40'],
            'duration' => ['required', 'string', 'max:80'],
            'status' => ['required', 'string', 'max:40'],
            'visibility_status' => ['nullable', 'in:Active,Inactive'],
        ]);

        return [
            'title' => $data['title'],
            'place' => $data['place'],
            'duration' => $data['duration'],
            'price' => $data['price'],
            'style' => $data['style'],
            'status' => $data['status'],
            'visibility_status' => $data['visibility_status'] ?? 'Active',
            'description' => $data['description'],
        ];
    }

    private function customTourPackagesData(): array
    {
        $path = storage_path('app/tour-packages.json');

        if (! File::exists($path)) {
            return [];
        }

        $packages = json_decode(File::get($path), true);

        return is_array($packages) ? $packages : [];
    }

    private function bookingsData(): array
    {
        $path = storage_path('app/bookings.json');

        if (! File::exists($path)) {
            return [];
        }

        $bookings = json_decode(File::get($path), true);

        return is_array($bookings) ? $bookings : [];
    }

    private function saveBookingsData(array $bookings): void
    {
        $path = storage_path('app/bookings.json');
        File::ensureDirectoryExists(dirname($path));
        File::put($path, json_encode(array_values($bookings), JSON_PRETTY_PRINT));
    }

    private function saveCustomTourPackagesData(array $packages): void
    {
        $path = storage_path('app/tour-packages.json');
        File::ensureDirectoryExists(dirname($path));
        File::put($path, json_encode(array_values($packages), JSON_PRETTY_PRINT));
    }

    private function uniqueTourSlug(string $title): string
    {
        $baseSlug = Str::slug($title) ?: 'tour-package';
        $slug = $baseSlug;
        $counter = 2;
        $existingSlugs = collect($this->tourPackagesData())->pluck('slug')->all();

        while (in_array($slug, $existingSlugs, true)) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
