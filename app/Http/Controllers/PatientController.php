<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::all();
        return view('patients.index', compact('patients'));
    }

    public function create()
    {
        return view('patients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'age' => 'required|integer',
            'diagnosis' => 'required',
            'room_number' => 'required',
        ]);
        Patient::create($request->all());
        return redirect()->route('patients.index')->with('success', 'تم إضافة المريض بنجاح');
    }

    public function edit($id)
    {
        $patient = Patient::findOrFail($id);
        return view('patients.edit', compact('patient'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'age' => 'required|integer',
            'diagnosis' => 'required',
            'room_number' => 'required',
        ]);
        $patient = Patient::findOrFail($id);
        $patient->update($request->all());
        return redirect()->route('patients.index')->with('success', 'تم تحديث بيانات المريض');
    }

    public function destroy($id)
    {
        Patient::destroy($id);
        return redirect()->route('patients.index')->with('success', 'تم حذف المريض');
    }
}
