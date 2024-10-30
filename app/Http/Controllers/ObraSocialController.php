<?php

namespace App\Http\Controllers;

use App\Models\ObraSocial;
use Illuminate\Http\Request;

class ObraSocialController extends Controller
{
    public function index()
    {
        $obrasSociales = ObraSocial::all();
        return view('obras-sociales.index', compact('obrasSociales'));
    }

    public function create()
    {
        return view('obras-sociales.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|max:255',
        ]);

        $obraSocial = new ObraSocial();
        $obraSocial->nombre = $validated['nombre'];
        $obraSocial->save();

        return redirect()->route('obras-sociales.index')->with('success', 'Obra social creada con éxito.');
    }

    public function show(ObraSocial $obraSocial)
    {
        return view('obras-sociales.show', compact('obraSocial'));
    }

    public function edit(ObraSocial $obraSocial)
    {
        return view('obras-sociales.edit', compact('obraSocial'));
    }

    public function update(Request $request, ObraSocial $obraSocial)
    {
        $validated = $request->validate([
            'nombre' => 'required|max:255',
        ]);

        $obraSocial->nombre = $validated['nombre'];
        $obraSocial->save();

        return redirect()->route('obras-sociales.index')->with('success', 'Obra social actualizada con éxito.');
    }

    public function destroy(ObraSocial $obraSocial)
    {
        $obraSocial->delete();

        return redirect()->route('obras-sociales.index')->with('success', 'Obra social eliminada con éxito.');
    }
}
