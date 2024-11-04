<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StaffController extends Controller
{
    public function index()
    {
        $staffs = Staff::with('person')->get();
        return view('staffs.index', compact('staffs'));
    }
    
    public function create()
    {
        $people = Person::all();
        $positions = collect([
            (object) ['id' => 1, 'name' => 'secretary'],
            (object) ['id' => 2, 'name' => 'cleaning staff'],
            (object) ['id' => 3, 'name' => 'technician'],
        ]);
        return view('staffs.create', compact('people', 'positions'));
    }

    public function store(Request $request)
    {
        dd($request->all());   
        $request->validate([
            'person_id' => 'required|exists:people,id',
            'position' => 'required|int',
        ]);
        DB::beginTransaction();
        try {
            $staff = new Staff();
            $staff->person_id = $request->person_id;
            $staff->position = $request->position;
            $staff->save();

            DB::commit();
            return redirect()->route('staffs.index')->with('success', 'Staff creado exitosamente.');
        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollBack();
            return back()->withErrors(['msg' => 'Hubo un error al crear el staff.'])->withInput();
        }
    }

    public function show($id)
    {
        $staff = Staff::with('person')->find($id);
        return view('staffs.show', compact('staff'));
    }

    public function edit(Staff $staff)
    {
        $people = Person::all();
        return view('staffs.edit', compact('staff', 'people'));
    }

    public function update(Request $request, Staff $staff)
    {
        $request->validate([
            'person_id' => 'required|exists:people,id',
        ]);

        DB::beginTransaction();
        try {
            $staff->update($request->only(['person_id']));
            DB::commit();
            return redirect()->route('staffs.index')->with('success', 'Staff actualizado exitosamente.');
        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollBack();
            return back()->withErrors(['msg' => 'Hubo un error al actualizar el staff.'])->withInput();
        }
    }

    public function destroy(Staff $staff)
    {
        DB::beginTransaction();
        try {
            $staff->delete();
            DB::commit();
            return redirect()->route('staffs.index')->with('success', 'Staff eliminado exitosamente.');
        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollBack();
            return back()->withErrors(['msg' => 'Hubo un error al eliminar el staff.']);
        }
    }
}
