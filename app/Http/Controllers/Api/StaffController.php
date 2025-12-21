<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of active staff.
     */
    public function index(Request $request)
    {
        $query = Staff::active()->ordered();

        $perPage = $request->get('per_page', 20);
        $staff = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $staff,
        ]);
    }

    /**
     * Display the specified staff member.
     */
    public function show($id)
    {
        $staff = Staff::active()->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $staff,
        ]);
    }

    /**
     * Get all active staff (without pagination).
     */
    public function all()
    {
        $staff = Staff::active()->ordered()->get();

        return response()->json([
            'success' => true,
            'data' => $staff,
        ]);
    }
}
