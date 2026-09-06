<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/destinations', [HomeController::class, 'destinations'])->name('destinations');
Route::get('/tour-packages', [HomeController::class, 'tourPackages'])->name('tour-packages');
Route::get('/tour-packages/{slug}/booking', [HomeController::class, 'booking'])->name('booking.checkout');
Route::post('/tour-packages/{slug}/booking', [HomeController::class, 'storeBooking'])->name('booking.store');
Route::get('/booking-details/{reference}', [HomeController::class, 'bookingDetails'])->name('booking.details');
Route::get('/tour-packages/{slug}', [HomeController::class, 'tourDetail'])->name('tour.show');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/client-login', [HomeController::class, 'clientLogin'])->name('client.login');
Route::get('/client', [HomeController::class, 'clientDashboard'])->name('client.dashboard');
Route::get('/admin000', [HomeController::class, 'adminLogin'])->name('admin.login');
Route::post('/admin000', [HomeController::class, 'adminAuthenticate'])->name('admin.authenticate');
Route::post('/admin000/logout', [HomeController::class, 'adminLogout'])->name('admin.logout');
Route::get('/admin/tour-packages', [HomeController::class, 'tourPackageManagement'])->name('admin.tour-packages');
Route::get('/admin/bookings', [HomeController::class, 'bookings'])->name('admin.bookings');
Route::get('/admin/clients', [HomeController::class, 'clients'])->name('admin.clients');
Route::get('/admin/tour-packages/create', [HomeController::class, 'createTourPackage'])->name('admin.tour-packages.create');
Route::post('/admin/tour-packages', [HomeController::class, 'storeTourPackage'])->name('admin.tour-packages.store');
Route::get('/admin/tour-packages/{slug}/edit', [HomeController::class, 'editTourPackage'])->name('admin.tour-packages.edit');
Route::put('/admin/tour-packages/{slug}', [HomeController::class, 'updateTourPackage'])->name('admin.tour-packages.update');
Route::patch('/admin/tour-packages/{slug}/visibility', [HomeController::class, 'updateTourPackageVisibility'])->name('admin.tour-packages.visibility');
Route::post('/generate', [HomeController::class, 'generate'])->name('generate');
