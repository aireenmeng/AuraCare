<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    // 1. Show the Booking Calendar to the Patient
    public function create()
    {
        // Fetch all active services for the dropdown menu
        $services = Service::orderBy('category')->get();
        return view('patient.book', compact('services'));
    }

    // 2. Save the Patient's Booking Request
    public function store(Request $request)
    {
        // Rubric Requirement: Form Validation
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required'
        ]);

        // CONFLICT CHECKER LOGIC: Prevent double booking!
        $isBooked = Appointment::where('appointment_date', $request->appointment_date)
                               ->where('start_time', $request->start_time)
                               ->whereIn('status', ['Pending', 'Confirmed'])
                               ->exists();

        if ($isBooked) {
            return back()->with('error', 'Sorry, that time slot is already taken. Please choose another time.')->withInput();
        }

        // Save the appointment
        Appointment::create([
            'user_id' => Auth::id(),
            'service_id' => $request->service_id,
            'appointment_date' => $request->appointment_date,
            'start_time' => $request->start_time,
            'status' => 'Pending' // Requires admin approval
        ]);

        return redirect()->route('dashboard')->with('success', 'Your appointment request has been sent! Please wait for clinic confirmation.');
    }

    // ==========================================
    // ADMIN METHODS
    // ==========================================

    // 1. Show the Master Schedule (All Appointments)
    public function index()
    {
        // Security check: Only Admins can view this page
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized Access.');
        }

        // Fetch appointments with the patient (user) and service details attached
        // Order by date and time so the soonest appointments are at the top
        $appointments = Appointment::with(['user', 'service'])
            ->orderBy('appointment_date', 'asc')
            ->orderBy('start_time', 'asc')
            ->paginate(10);

        return view('admin.appointments.index', compact('appointments'));
    }

    // 2. Update the Status of an Appointment (Approve/Complete/Cancel)
    public function updateStatus(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized Access.');
        }

        $request->validate([
            'status' => 'required|in:Pending,Confirmed,Completed,Cancelled'
        ]);

        $appointment = Appointment::findOrFail($id);
        $appointment->update(['status' => $request->status]);

        return back()->with('success', 'Appointment status updated to ' . $request->status . '!');
    }
}