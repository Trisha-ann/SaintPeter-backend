<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Models\Payments;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Payments::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PaymentRequest $request)
    {
        $payment = Payments::create([
            'customers_id' => $request->customers_id,
            'plan_id' => $request->plan_id,
            'employee_id' => $request->employee_id,
            'purchased_payable' => $request->purchased_payable,
            'amount_received' => $request->amount_received,
            'balance' => $request->balance,
            'payment_duration' => $request->payment_duration,
        ]);

        return response()->json($payment, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Payments::findOrFail($id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deletedRows = Payments::destroy($id);

        if($deletedRows > 0){
            return response()->json(['message' => 'Payment record deleted successfully.'], 200);
        }
        else{
            return response()->json(['message' => 'Payment not found'], 404);
        }
    }
}
