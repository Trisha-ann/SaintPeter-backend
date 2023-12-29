<?php

namespace App\Http\Controllers\Api;

use App\Models\Employee;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Employee::all();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        $employee = Employee::create([
            'employee_id' => $request->employee_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'password' => Hash::make($request->password),
        ]);

        return response()->json($employee, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Employee::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, string $id)
    {
        $employee = Employee::findOrFail($id);
        $employee->first_name = $request->get('first_name', $employee->first_name);
        $employee->last_name = $request->get('last_name', $employee->last_name);
        $employee->password = $request->get('password') ? Hash::make($request->password) : $employee->password;
        $employee->save();

        return response()->json($employee, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deletedRows = Employee::destroy($id);

        if($deletedRows > 0){
            return response()->json(['message' => 'Employee member deleted successfully.'], 200);
        }
        else{
            return response()->json(['message' => 'Employee member not found'], 404);
        }
    }
}
