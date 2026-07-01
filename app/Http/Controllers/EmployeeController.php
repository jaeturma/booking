<?php

namespace App\Http\Controllers;

use App\Models\User;

class EmployeeController extends Controller
{
    // GET /api/employees/validate/{employee_no}
    public function validateByNo(string $employee_no)
    {
        if (!preg_match('/^\d{7}$/', $employee_no)) {
            return response()->json(['message' => 'Invalid format'], 422);
        }
        $user = User::with('office')->where('employee_no', $employee_no)->first();
        if (!$user) {
            return response()->json(['ok' => false], 404);
        }
        return response()->json([
            'ok' => true,
            'name' => $user->name,
            'id' => $user->id,
            'office_id' => $user->office_id,
            'office_name' => optional($user->office)->name,
            'district' => optional($user->office)->district,
        ]);
    }
}
