<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Http\Resources\LeaveQuotaResource;
use App\Http\Resources\LeaveResource;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    // Daftar karyawan yang saat ini pernah mengambil cuti.
    public function index()
    {
        $employees = Employee::withSum('leaves', 'lama_cuti')->whereHas('leaves')->get();
        return LeaveResource::collection($employees);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // Daftar sisa cuti setiap karyawan (quota cuti 12 hari/tahun). Daftar berisikan; nomor_induk, nama, sisa_cuti.
    public function leaveQuota()
    {
        $employees = Employee::withCount('leaves')->get();
        return LeaveQuotaResource::collection($employees);
    }
}
