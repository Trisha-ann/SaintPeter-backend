<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
        if(request()->routeIs('employee.store')){
            return[
                'employee_id' => 'required|string|max:9',
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'password' => 'required|string|min:8',
            ];
        } elseif (request()->routeIs('employee.update')) {
            return [
                'first_name' => 'sometimes|string|max:255',
                'last_name' => 'sometimes|string|max:255',
                'password' => 'sometimes|string|min:8',
            ];
        } else {
            return [];
        }
    }
}
