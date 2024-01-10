<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if(request()->routeIs('payments.store')){
            return[
                'customers_id' => 'required|integer',
                'plan_id' => 'required|integer',
                'employee_id' => 'required|string|max:255',
                'purchased_payable' => ['required', 'regex:/^\d+(\.\d{2})?$/'], //accept 2 decimal places
                'amount_received' => ['required', 'regex:/^\d+(\.\d{2})?$/'],
                'balance' => ['required', 'regex:/^\d+(\.\d{2})?$/'],
                'payment_duration' => 'required|string|max:255',
            ];
           }else{
            return [
                
            ];
           }
    }
}
