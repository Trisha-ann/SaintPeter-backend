<?php

namespace App\Http\Controllers\Api;

use App\Models\Customers;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Customers::all();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerRequest $request)
    {
        $customer = Customers::create([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'address' => $request->address,
            'age' => $request->age,
            'gender' => $request->gender,
            'birth_date' => $request->birth_date,
            'death_date' => $request->death_date,
            'employee_id' => $request->employee_id,
        ]);

        return response()->json($customer, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Customers::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerRequest $request, string $id)
    {
        $customer = Customers::findOrFail($id);
        $customer->last_name = $request->get('last_name', $customer->last_name);
        $customer->first_name = $request->get('first_name', $customer->first_name);
        $customer->address = $request->get('address', $customer->address);
        $customer->age = $request->get('age', $customer->age);
        $customer->gender = $request->get('gender', $customer->gender);
        $customer->birth_date = $request->get('birth_date', $customer->birth_date);
        $customer->death_date = $request->get('death_date', $customer->death_date);
        $customer->employee_id = $request->get('employee_id', $customer->employee_id);
        $customer->save();

        return response()->json($customer, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deletedRows = Customers::destroy($id);

        if($deletedRows > 0){
            return response()->json(['message' => 'Customer deleted successfully.'], 200);
        }
        else{
            return response()->json(['message' => 'Customer not found'], 404);
        }
    }
}
