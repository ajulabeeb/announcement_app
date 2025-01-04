<?php

use App\Http\Controllers\AnnouncementController;
use Illuminate\Support\Facades\Route;


Route::get('announcements/active', [AnnouncementController::class, 'active'])->name('announcements.active');
Route::resource('announcements', AnnouncementController::class)->only(['index', 'store', 'destroy']);
