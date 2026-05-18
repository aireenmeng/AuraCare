<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Models\User;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    // 1. If the user is an ADMIN, fetch clinic statistics
    if (Auth::user()->role === 'admin') {
        $todayAppointments = Appointment::whereDate('appointment_date', Carbon::today())->count();
        $totalPatients = User::where('role', 'patient')->count();
        $pendingRequests = Appointment::where('status', 'Pending')->count();

        return view('dashboard', compact('todayAppointments', 'totalPatients', 'pendingRequests'));
    } 
    // 2. If the user is a PATIENT, fetch their specific next appointment
    else {
        $nextAppointment = Appointment::with('service')
            ->where('user_id', Auth::id())
            ->whereIn('status', ['Pending', 'Confirmed'])
            ->whereDate('appointment_date', '>=', Carbon::today())
            ->orderBy('appointment_date', 'asc')
            ->first();

        return view('dashboard', compact('nextAppointment'));
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // These must go BEFORE the resource route
    Route::get('services/archived', [App\Http\Controllers\ServiceController::class, 'archived'])->name('services.archived');
    Route::post('services/{id}/restore', [App\Http\Controllers\ServiceController::class, 'restore'])->name('services.restore');
    
    Route::resource('services', App\Http\Controllers\ServiceController::class);
    // Patient Portal Routes
    Route::get('/our-services', [App\Http\Controllers\PatientController::class, 'services'])->name('patient.services');
    // Patient Booking Routes
    Route::get('/book-appointment', [App\Http\Controllers\AppointmentController::class, 'create'])->name('appointments.book');
    Route::post('/book-appointment', [App\Http\Controllers\AppointmentController::class, 'store'])->name('appointments.store');
    // Admin Appointment Routes
    Route::get('/manage-appointments', [App\Http\Controllers\AppointmentController::class, 'index'])->name('appointments.index');
    Route::patch('/manage-appointments/{id}/status', [App\Http\Controllers\AppointmentController::class, 'updateStatus'])->name('appointments.updateStatus');
    // Digital Treatment Record Routes (Admin Only)
    Route::get('/patients', [App\Http\Controllers\PatientRecordController::class, 'index'])->name('patients.index');
    Route::get('/patients/{id}', [App\Http\Controllers\PatientRecordController::class, 'show'])->name('patients.show');
    Route::post('/patients/record/{appointment_id}', [App\Http\Controllers\PatientRecordController::class, 'storeRecord'])->name('patients.storeRecord');
    Route::get('/my-history', [App\Http\Controllers\PatientController::class, 'history'])->name('patient.history');

    // Admin Report Routes
    Route::get('/reports/monthly-pdf', [App\Http\Controllers\ReportController::class, 'monthlyAppointments'])->name('reports.monthly');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
