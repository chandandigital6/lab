<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendersRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'company_name' => 'required',
            'contact_person_name' => 'required',
            'email_id' => 'required',
            'phone_no' => 'integer',
            'product_categories.*' => 'required|exists:product_categories,id',
            'product_categories' => [
                'required',
                function ($attribute, $value, $fail) {
                    request()->merge(['product_categories' => json_encode($value)]);
                },
            ],
        ];

    }
}
