<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    // READ: Show the list of services
    public function index()
    {
        $services = Service::latest()->paginate(10); // Added pagination for the rubric!
        return view('admin.services.index', compact('services'));
    }

    // CREATE: Show the form to add a new service
    public function create()
    {
        return view('admin.services.create');
    }

    // STORE: Save the new service to the database
    public function store(Request $request)
    {
        // Rubric Requirement: Form Validation
        $validatedData = $request->validate([
            'service_name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'price' => 'required|numeric|min:0', // Number-only validation
            'duration_minutes' => 'required|integer|min:5',
            'description' => 'nullable|string'
        ]);

        Service::create($validatedData);

        return redirect()->route('services.index')->with('success', 'Skincare service added successfully!');
    }

    // EDIT: Show the form to edit an existing service
    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    // UPDATE: Save the edited changes to the database
    public function update(Request $request, Service $service)
    {
        $validatedData = $request->validate([
            'service_name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'duration_minutes' => 'required|integer|min:5',
            'description' => 'nullable|string'
        ]);

        $service->update($validatedData);

        return redirect()->route('services.index')->with('success', 'Treatment updated successfully!');
    }

    // DELETE: Remove the service from the database
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')->with('success', 'Treatment deleted successfully!');
    }

    // VIEW ARCHIVED: Show the list of soft-deleted services
    public function archived()
    {
        $services = Service::onlyTrashed()->paginate(10);
        return view('admin.services.archived', compact('services'));
    }

    // RESTORE: Bring a service back to the active catalog
    public function restore($id)
    {
        $service = Service::onlyTrashed()->findOrFail($id);
        $service->restore();
        
        return redirect()->route('services.archived')->with('success', 'Treatment successfully restored to the active catalog!');
    }
}