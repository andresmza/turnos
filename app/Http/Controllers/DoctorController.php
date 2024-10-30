<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Specialty;
use App\Models\Person;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::with('person')->get();
        return view('doctors.index', compact('doctors'));
    }

    public function create()
    {
        $specialties = Specialty::getAllSpecialties();
        return view('doctors.create', compact('specialties'));
    }

    public function store(Request $request)
{
    DB::beginTransaction();

    try {
        // Crear el usuario
        $user = new User();
        $user->name = $request->first_name . ' ' . $request->last_name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        // Crear la persona
        $person = new Person();
        $person->first_name = $request->first_name;
        $person->last_name = $request->last_name;
        $person->document = $request->document;
        $person->email = $request->email;
        $person->phone = $request->phone;
        $person->birth_date = $request->birth_date;
        $person->gender = $request->gender;
        $person->save();

        // Crear el doctor
        $doctor = new Doctor();
        $doctor->user_id = $user->id;
        $doctor->person_id = $person->id;
        $doctor->specialty_id = $request->specialty_id;
        $doctor->license_number = $request->license_number;
        $doctor->save();

        DB::commit();

        return redirect()->route('doctors.index');
    } catch (\Throwable $th) {
        Log::error($th);
        DB::rollBack();
        return back()->withErrors(['msg' => 'Hubo un error al crear el doctor.'])->withInput();
    }
}

    public function show($id)
    {
        $doctor = Doctor::with(['person', 'specialty'])->find($id);
        return view('doctors.show', compact('doctor'));
    }

    public function edit(Doctor $doctor)
    {
        $doctor->load(['person', 'specialty']);
        // dd($doctor);
        return view('doctors.edit', compact('doctor'), [
            'specialties' => Specialty::all(),
        ]);
    }

    public function update(Request $request, Doctor $doctor)
    {
        Log::info('test');
        // dd($request);
        $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'document' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'birth_date' => 'required|date',
            'gender' => 'required|in:M,F',
            'specialty_id' => 'required|exists:specialties,id',
            'license_number' => 'required',
        ]);
        DB::beginTransaction();
        Log::info(0);

        try {
            $user = $doctor->user;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();
            Log::info(1);
            // Update Person
            $person = $doctor->person;
            $person->first_name = $request->name;
            $person->last_name = $request->last_name;
            $person->document = $request->document;
            $person->email = $request->email;
            $person->phone = $request->phone;
            $person->birth_date = $request->birth_date;
            $person->gender = $request->gender;
            $person->save();
            Log::info(2);
            
            // Update Doctor
            $doctor->specialty_id = $request->specialty_id;
            $doctor->license_number= $request->license_number;
            // dump($doctor->license_number);
            Log::info(3);
            Log::info($doctor->licence_number); 
            $doctor->save();
            Log::info($doctor->licence_number); 

            DB::commit();
            return redirect()->route('doctors.index')->with('success', 'Doctor updated successfully.');
        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollBack();
            return back()->withErrors(['msg' => 'There was an error updating the doctor.'])->withInput();
        }
    }

    public function destroy($id)
    {
        $doctor = Doctor::find($id);
        $doctor->delete();
        return redirect()->route('doctors.index');
    }
}
