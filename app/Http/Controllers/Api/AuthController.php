<?php

namespace App\Http\Controllers\Api;

use App\Models\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
/**
     * Login the specified user.
     */ public function login(AuthRequest $request)
     {
        $staff = Employee::where('employee_id', $request->employee_id)->first(); 

        if ($staff && Hash::check($request->password, $staff->password)) {
            $response = [
                'staff' => $staff,
                'staff_token' => $staff->createToken('auth_token')->plainTextToken,
            ];
        } else {
            throw ValidationException::withMessages([
                'employee_id' => ['The provided credentials are incorrect.'],
            ]);
        }

        return response($response, 200);
    }

    /**
     * Logout the specified user.
     */
    public function logout(Request $request)
    {
        $request
            ->user()
            ->currentAccessToken()
            ->delete();

        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }
}
