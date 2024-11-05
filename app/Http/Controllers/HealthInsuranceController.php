<?php

namespace App\Http\Controllers;

use App\Models\HealthInsurance;
use Illuminate\Http\Request;

class HealthInsuranceController extends Controller
{
    public function index()
    {
        $healthInsurances = HealthInsurance::all();
        return view('health-insurances.index', compact('healthInsurances'));
    }

    public function create()
    {
        return view('health-insurances.create');
    }

    public function store(Request $request)
    {
        // dd($request);
        $validated = $request->validate([
            'name' => 'required|max:255',
        ]);

        $healthInsurance = new HealthInsurance();
        $healthInsurance->name = $validated['name'];
        $healthInsurance->save();

        return redirect()->route('health-insurances.index')->with('success', 'Health insurance created successfully.');
    }

    public function show(HealthInsurance $healthInsurance)
    {
        return view('health-insurances.show', compact('healthInsurance'));
    }

    public function edit(HealthInsurance $healthInsurance)
    {
        return view('health-insurances.edit', compact('healthInsurance'));
    }

    public function update(Request $request, HealthInsurance $healthInsurance)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
        ]);

        $healthInsurance->Name = $validated['name'];
        $healthInsurance->save();

        return redirect()->route('health-insurances.index')->with('success', 'Health insurance updated successfully.');
    }

    public function destroy(HealthInsurance $healthInsurance)
    {
        $healthInsurance->delete();

        return redirect()->route('health-insurances.index')->with('success', 'Health insurance deleted successfully.');
    }
}
