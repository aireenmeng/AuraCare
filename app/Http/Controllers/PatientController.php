<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    // Display the public service catalog for patients
    public function services()
    {
        // Fetch only active services (SoftDeletes automatically hides archived ones!)
        // We group them by category so the UI looks organized
        $servicesByCategory = Service::all()->groupBy('category');
        
        return view('patient.services', compact('servicesByCategory'));
    }

    // View Patient's personal appointment history and records
    public function history()
    {
        // Fetch appointments only for the logged-in user
        // We load the 'service' and 'treatmentRecord' relationships automatically
        $appointments = \App\Models\Appointment::with(['service', 'treatmentRecord'])
            ->where('user_id', \Illuminate\Support\Facades\Auth::id())
            ->orderBy('appointment_date', 'desc')
            ->orderBy('start_time', 'desc')
            ->get();

        // Split them into upcoming and past for a cleaner UI
        $upcoming = $appointments->whereIn('status', ['Pending', 'Confirmed']);
        $past = $appointments->whereIn('status', ['Completed', 'Cancelled']);

        return view('patient.history', compact('upcoming', 'past'));
    }
}