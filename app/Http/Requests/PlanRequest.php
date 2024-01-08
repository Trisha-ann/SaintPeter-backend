<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanRequest extends FormRequest
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
       if(request()->routeIs('plans.store')){
        return[
            'plan_name' => 'required|string|max:255',
            'plan_type' => 'required|string|max:255',
            'plan_price' => ['required', 'regex:/^\d+(\.\d{2})?$/'], //accept 2 decimal places for the price
        ];
       }elseif (request()->routeIs('plans.update')){
        return[
            'plan_name' => 'sometimes|string|max:255',
            'plan_type' => 'sometimes|string|max:255',
            'plan_price' => ['sometimes', 'regex:/^\d+(\.\d{2})?$/'], //accept 2 decimal places
        ];
       }else{
        return [
            
        ];
       }
    }
}
