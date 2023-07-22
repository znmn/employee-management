<?php

namespace App\Http\Controllers;

use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::all();
        return EmployeeResource::collection($employees);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nomor_induk' => 'required|unique:employees',
            'nama' => 'required',
            'alamat' => 'nullable',
            'tanggal_lahir' => 'nullable|date|before:now',
            'tanggal_masuk' => 'nullable|date',
        ]);

        $validatedData['tanggal_masuk'] = $validatedData['tanggal_masuk'] ?? now();

        $employee = Employee::create($validatedData);
        return response()->json([
            'message' => 'Employee created'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $employee = Employee::find($id);
        return $employee ? new EmployeeResource($employee) : response()->json([
            'message' => 'Employee not found'
        ], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $employee = Employee::find($id);
        if (!$employee) {
            return response()->json([
                'message' => 'Employee not found'
            ], 404);
        }

        $validatedData = $request->validate([
            'nomor_induk' => 'required|unique:employees,nomor_induk,' . $id,
            'nama' => 'required',
            'alamat' => 'nullable',
            'tanggal_lahir' => 'nullable|date|before:now',
            'tanggal_masuk' => 'nullable|date',
        ]);

        $employee->update($validatedData);
        return response()->json([
            'message' => 'Employee updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::find($id);
        if (!$employee) {
            return response()->json([
                'message' => 'Employee not found'
            ], 404);
        }

        $employee->delete();
        return response()->json([
            'message' => 'Employee deleted'
        ]);
    }

    // Daftar 3 karyawan yang pertama kali bergabung.
    public function firstThree()
    {
        $employees = Employee::orderBy('tanggal_masuk', 'asc')->limit(3)->get();
        return EmployeeResource::collection($employees);
    }
}
