<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Appointment;
use App\Models\TreatmentRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PatientRecordController extends Controller
{
    // 1. Patient Directory: Show all registered patients
    public function index()
    {
        // Only fetch users who are patients, and count their total completed appointments
        $patients = User::where('role', 'patient')
                        ->withCount(['appointments' => function ($query) {
                            $query->where('status', 'Completed');
                        }])
                        ->paginate(10);
                        
        return view('admin.patients.index', compact('patients'));
    }

    // 2. Specific Patient File: Show history and portfolio
    public function show($id)
    {
        $patient = User::findOrFail($id);
        
        // Fetch all appointments for this patient, bringing the related service and treatment record along
        $appointments = Appointment::with(['service', 'treatmentRecord'])
                                   ->where('user_id', $id)
                                   ->orderBy('appointment_date', 'desc')
                                   ->get();

        return view('admin.patients.show', compact('patient', 'appointments'));
    }

    // 3. Save Post-Treatment Note & Upload Photo
    public function storeRecord(Request $request, $appointment_id)
    {
        $request->validate([
            'staff_notes' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048' // Max 2MB image
        ]);

        // Handle the Image Upload
        $photoPath = null;
        if ($request->hasFile('photo')) {
            // Save into the 'portfolios' folder in the public storage
            $photoPath = $request->file('photo')->store('portfolios', 'public');
        }

        // Create the record in the database
        TreatmentRecord::create([
            'appointment_id' => $appointment_id,
            'staff_notes' => $request->staff_notes,
            'photo_path' => $photoPath,
        ]);

        return back()->with('success', 'Treatment record and photo successfully saved to patient file!');
    }

    public function services()
    {
        // Fetch only active services and group them by category
        $servicesByCategory = Service::all()->groupBy('category');
        
        // Point to the new public view!
        return view('public.services', compact('servicesByCategory'));
    }
}