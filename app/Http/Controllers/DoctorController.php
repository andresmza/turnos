<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Especialidad;
use App\Models\Persona;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DoctorController extends Controller
{
    public function index()
    {
        $doctores = Doctor::with('persona')->get();
        return view('doctores.index', compact('doctores'));
    }

    public function create()
    {
        $especialidades = Especialidad::getAllEspecialidades();
        return view('doctores.create', compact('especialidades'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $user = new User();

            $user->name = $request->nombre;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();

            $persona = new Persona();
            $persona->nombre = $request->nombre;
            $persona->apellido = $request->apellido;
            $persona->documento = $request->documento;
            $persona->email = $request->email;
            $persona->telefono = $request->telefono;
            $persona->fecha_nacimiento = $request->fecha_nacimiento;
            $persona->sexo = $request->sexo;
            $persona->save();

            $doctor = new Doctor();
            $doctor->user_id = $user->id;
            $doctor->persona_id = $persona->id;
            $doctor->especialidad_id = $request->especialidad_id;
            $doctor->matricula = $request->matricula;
            $doctor->save();

            DB::commit();
        } catch (\Throwable $th) {
            Log::info($th);
            DB::rollBack();
        }


        return redirect()->route('doctores.index');
    }

    public function show($id)
    {
        $doctor = Doctor::with(['persona', 'especialidad'])->find($id);
        return view('doctores.show', compact('doctor'));
    }

    public function edit(Doctor $doctor)
    {
        $doctor->load(['persona', 'especialidad']);
        return view('doctores.edit', compact('doctor'), [
            'especialidades' => Especialidad::all(),
        ]);
    }

    public function update(Request $request, Doctor $doctor)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'documento' => 'required',
            'email' => 'required|email',
            'telefono' => 'required',
            'fecha_nacimiento' => 'required|date',
            'sexo' => 'required|in:M,F',
            'especialidad_id' => 'required|exists:especialidades,id',
            'matricula' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $user = $doctor->user;
            $user->name = $request->nombre;
            $user->email = $request->email;
            $user->save();

            // Actualizar Persona
            $persona = $doctor->persona;
            $persona->nombre = $request->nombre;
            $persona->apellido = $request->apellido;
            $persona->documento = $request->documento;
            $persona->email = $request->email;
            $persona->telefono = $request->telefono;
            $persona->fecha_nacimiento = $request->fecha_nacimiento;
            $persona->sexo = $request->sexo;
            $persona->save();

            // Actualizar Doctor
            $doctor->especialidad_id = $request->especialidad_id;
            $doctor->matricula = $request->matricula;
            $doctor->save();

            DB::commit();
            return redirect()->route('doctores.index')->with('success', 'Doctor actualizado correctamente.');
        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollBack();
            return back()->withErrors(['msg' => 'Hubo un error al actualizar el doctor.'])->withInput();
        }
    }


    public function destroy($id)
    {
        $doctor = Doctor::find($id);
        $doctor->delete();
        return redirect()->route('doctores.index');
    }
}
