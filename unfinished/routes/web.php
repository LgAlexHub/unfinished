<?php

use App\Http\Controllers\admin\MemberController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::middleware(['auth', 'verified'])->group(function(){
    Route::get('dashboard', fn() => Inertia::render('Dashboard'))->name('dashboard');
    Route::resource('membres', MemberController::class)->only(['index', 'store', 'update', 'destroy']);
});


require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
