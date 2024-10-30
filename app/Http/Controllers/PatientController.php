<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Person;
use App\Models\HealthInsurance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::getAllPatients();
        return view('patients.index', compact('patients'));
    }

    public function create()
    {
        $people = Person::all();
        $healthInsurances = HealthInsurance::all();
        // dd($people, $healthInsurances);
        return view('patients.create', compact('people', 'healthInsurances'));
    }

    public function store(Request $request)
{
    // Validaciones
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'document' => 'required|string|max:20',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:15',
        'birth_date' => 'required|date|before:today',
        'sex' => 'required|in:M,F',
        'health_insurance_id' => 'required|exists:health_insurances,id',
        'affiliate_number' => 'required|string|max:255',
    ]);

    DB::beginTransaction();

    try {
        // Crear persona
        $person = new Person([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'document' => $request->document,
            'email' => $request->email,
            'phone' => $request->phone,
            'birth_date' => $request->birth_date,
            'gender' => $request->sex, // Aquí mapeamos el campo `sex` al campo `gender`
        ]);
        $person->save();

        // Crear paciente
        $patient = new Patient($request->only(['health_insurance_id', 'affiliate_number']));
        $patient->person_id = $person->id;
        $patient->save();

        DB::commit();
        return redirect()->route('patients.index')->with('success', 'Paciente creado exitosamente.');
    } catch (\Throwable $th) {
        Log::error($th);
        DB::rollBack();
        return back()->withErrors(['msg' => 'Hubo un error al crear el paciente.'])->withInput();
    }
}



    public function show(Patient $patient)
    {
        $patient->load('healthInsurance');
        return view('patients.show', compact('patient'));
    }

    public function edit(Patient $patient)
    {
        $people = Person::all();
        $healthInsurances = HealthInsurance::all();
        
        return view('patients.edit', compact('patient', 'people', 'healthInsurances'));
    }

    public function update(Request $request, Patient $patient)
{
    // Validar los datos
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'document' => 'required|string|max:20',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:15',
        'birth_date' => 'required|date|before:today',
        'gender' => 'required|in:M,F', // Añadimos la validación para el campo gender
        'health_insurance_id' => 'required|exists:health_insurances,id',
        'affiliate_number' => 'required|string|max:255',
    ]);

    DB::beginTransaction();

    try {
        // Actualizar el paciente
        $patient->update($request->only(['health_insurance_id', 'affiliate_number']));

        // Actualizar la persona asociada al paciente
        $person = $patient->person;
        $person->update($request->only(['first_name', 'last_name', 'document', 'email', 'phone', 'birth_date', 'gender'])); // Agregamos gender aquí

        DB::commit();
        return redirect()->route('patients.index')->with('success', 'Paciente actualizado exitosamente.');
    } catch (\Throwable $th) {
        Log::error($th);
        DB::rollBack();
        return back()->withErrors(['msg' => 'Hubo un error al actualizar el paciente.'])->withInput();
    }
}


    public function destroy(Patient $patient)
    {
        DB::beginTransaction();

        try {
            $patient->delete();

            DB::commit();
            return redirect()->route('patients.index')->with('success', 'Paciente eliminado exitosamente.');
        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollBack();
            return back()->withErrors(['msg' => 'Hubo un error al eliminar el paciente.']);
        }
    }
}
