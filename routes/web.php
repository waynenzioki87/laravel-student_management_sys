<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/enrollment', [EnrollmentController::class, 'index'])->name('enrollment');
    Route::post('/enrollment', [EnrollmentController::class, 'store'])->name('enrollment.store');
    Route::get('/enrollment/{enrollment}/edit', [EnrollmentController::class, 'edit'])->name('enrollment.edit');
    Route::put('/enrollment/{enrollment}', [EnrollmentController::class, 'update'])->name('enrollment.update');
    Route::delete('/enrollment/{enrollment}', [EnrollmentController::class, 'destroy'])->name('enrollment.destroy');
    Route::view('/fees', 'placeholder')->name('fees');
    Route::view('/payments', 'placeholder')->name('payments');
    Route::view('/reports', 'placeholder')->name('reports');
    Route::view('/settings', 'settings')->name('settings');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('courses', CourseController::class);
    Route::resource('students', StudentController::class);

});

require __DIR__.'/auth.php';
