<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Persona;
use App\Models\ObraSocial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PacienteController extends Controller
{
    public function index()
    {
        $pacientes = Paciente::getAllPacientes();
        return view('pacientes.index', compact('pacientes'));
    }

    public function create()
    {
        $personas = Persona::all();
        $obrasSociales = ObraSocial::all();
        dd($personas, $obrasSociales);
        return view('pacientes.create', compact('personas', 'obrasSociales'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'persona_id' => 'required|exists:personas,id',
            'obra_social_id' => 'required|exists:obras_sociales,id',
            'numero_afiliado' => 'required|string|max:255',
        ]);

        DB::beginTransaction();

        try {
            $persona = new Persona($request->only(['nombre', 'apellido', 'edad'])); // Replace 'nombre', 'apellido', 'edad' with the actual form fields
            $persona->save();

            $paciente = new Paciente($request->only(['obra_social_id', 'numero_afiliado']));
            $paciente->persona_id = $persona->id;
            $paciente->save();

            DB::commit();
            return redirect()->route('pacientes.index')->with('success', 'Paciente creado con éxito.');
        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollBack();
            return back()->withErrors(['msg' => 'Hubo un error al crear el paciente.'])->withInput();
        }
        

        DB::beginTransaction();

        try {
            $paciente = new Paciente($request->only(['persona_id', 'obra_social_id', 'numero_afiliado']));
            $paciente->save();

            DB::commit();
            return redirect()->route('pacientes.index')->with('success', 'Paciente creado con éxito.');
        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollBack();
            return back()->withErrors(['msg' => 'Hubo un error al crear el paciente.'])->withInput();
        }
    }

    public function show(Paciente $paciente)
    {
        return view('pacientes.show', compact('paciente'));
    }

    public function edit(Paciente $paciente)
    {
        $personas = Persona::all();
        $obrasSociales = ObraSocial::all();
        return view('pacientes.edit', compact('paciente', 'personas', 'obrasSociales'));
    }

    public function update(Request $request, Paciente $paciente)
    {
        DB::beginTransaction();

        try {
            $paciente->update($request->only(['obra_social_id', 'numero_afiliado']));

            $persona = $paciente->persona;
            $persona->update($request->only(['nombre', 'apellido', 'edad', 'documento', 'email', 'telefono', 'fecha_nacimiento']));

            DB::commit();
            return redirect()->route('pacientes.index')->with('success', 'Paciente actualizado con éxito.');
        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollBack();
            return back()->withErrors(['msg' => 'Hubo un error al actualizar el paciente.'])->withInput();
        }
    }

    public function destroy(Paciente $paciente)
    {
        DB::beginTransaction();

        try {
            $paciente->delete();

            DB::commit();
            return redirect()->route('pacientes.index')->with('success', 'Paciente eliminado con éxito.');
        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollBack();
            return back()->withErrors(['msg' => 'Hubo un error al eliminar el paciente.']);
        }
    }
}
