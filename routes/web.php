<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Appointment;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PatientRecordController;
use App\Http\Controllers\ReportController;

// =======================================================
// 1. PUBLIC ROUTES (Guests can access these)
// =======================================================
Route::get('/', function () {
    return view('welcome');
});

Route::get('/our-services', [PatientController::class, 'services'])->name('patient.services');

// =======================================================
// 2. DASHBOARD ROUTE (Smart Redirect)
// =======================================================
Route::get('/dashboard', function () {
    if (Auth::user()->role === 'admin') {
        $todayAppointments = Appointment::whereDate('appointment_date', Carbon::today())->count();
        $totalPatients = User::where('role', 'patient')->count();
        $pendingRequests = Appointment::where('status', 'Pending')->count();

        return view('dashboard', compact('todayAppointments', 'totalPatients', 'pendingRequests'));
    } else {
        $nextAppointment = Appointment::with('service')
            ->where('user_id', Auth::id())
            ->whereIn('status', ['Pending', 'Confirmed'])
            ->whereDate('appointment_date', '>=', Carbon::today())
            ->orderBy('appointment_date', 'asc')
            ->first();

        return view('dashboard', compact('nextAppointment'));
    }
})->middleware(['auth', 'verified'])->name('dashboard');

// =======================================================
// 3. AUTHENTICATED ROUTES (Requires Login)
// =======================================================
Route::middleware('auth')->group(function () {
    
    // --- PATIENT MODULES ---
    Route::get('/book-appointment', [AppointmentController::class, 'create'])->name('appointments.book');
    Route::post('/book-appointment', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::get('/my-history', [PatientController::class, 'history'])->name('patient.history');

    // --- ADMIN: SERVICE CATALOG ---
    Route::get('services/archived', [ServiceController::class, 'archived'])->name('services.archived');
    Route::post('services/{id}/restore', [ServiceController::class, 'restore'])->name('services.restore');
    Route::resource('services', ServiceController::class);

    // --- ADMIN: MASTER SCHEDULE ---
    Route::get('/manage-appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::patch('/manage-appointments/{id}/status', [AppointmentController::class, 'updateStatus'])->name('appointments.updateStatus');

    // --- ADMIN: DIGITAL RECORDS ---
    Route::get('/patients', [PatientRecordController::class, 'index'])->name('patients.index');
    Route::get('/patients/{id}', [PatientRecordController::class, 'show'])->name('patients.show');
    Route::post('/patients/record/{appointment_id}', [PatientRecordController::class, 'storeRecord'])->name('patients.storeRecord');

    // --- ADMIN: REPORTS ---
    Route::get('/reports/monthly-pdf', [ReportController::class, 'monthlyAppointments'])->name('reports.monthly');
    
    // --- PROFILE MANAGEMENT ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';