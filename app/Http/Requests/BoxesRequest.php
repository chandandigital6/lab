<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BoxesRequest extends FormRequest
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
            'boxes_name'=>'required',
            'boxes_categories'=>'required',
            'number_of_boxes'=>'required',
        ];
    }
}
