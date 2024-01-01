<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
        if(request()->routeIs('customer.store')){
            return[
                'last_name' => 'required|string|max:255',
                'first_name' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'age' => 'required|integer',
                'gender' => 'required|string|max:50',
                'birth_date' => 'required|date',
                'death_date' => 'nullable|date',
                'employee_id' => 'required|string|max:9'
            ];
        } elseif (request()->routeIs('customer.update')) {
            return [
                'last_name' => 'sometimes|string|max:255',
                'first_name' => 'sometimes|string|max:255',
                'address' => 'sometimes|string|max:255',
                'age' => 'sometimes|integer',
                'gender' => 'sometimes|string|max:50',
                'birth_date' => 'sometimes|date',
                'death_date' => 'nullable|date',
                'employee_id' => 'sometimes|string|max:9'
            ];
        } else {
            return [];
        }
    }
}
