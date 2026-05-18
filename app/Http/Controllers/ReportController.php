<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf; // IMPORT THE PDF TOOL!
use Carbon\Carbon;

class ReportController extends Controller
{
    public function monthlyAppointments()
    {
        // Security Check
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized Access.');
        }

        $currentMonth = Carbon::now()->format('F Y');

        // Fetch only COMPLETED appointments for the current month
        $appointments = Appointment::with(['user', 'service'])
            ->where('status', 'Completed')
            ->whereMonth('appointment_date', Carbon::now()->month)
            ->whereYear('appointment_date', Carbon::now()->year)
            ->orderBy('appointment_date', 'asc')
            ->get();

        // Calculate the total revenue
        $totalRevenue = $appointments->sum(function ($appointment) {
            return $appointment->service->price;
        });

        // Load the special PDF view and pass the data
        $pdf = Pdf::loadView('admin.reports.monthly_pdf', compact('appointments', 'currentMonth', 'totalRevenue'));

        // Force the browser to download the file
        return $pdf->download('AuraCare_Monthly_Report_' . Carbon::now()->format('m_Y') . '.pdf');
    }
}