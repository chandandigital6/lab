<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuoteRequest extends FormRequest
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
             'user_id'=>'required',
             'quotation_submitted'=>'required',
             'accepted_quotation'=>'required',
             'product_status_sheet_delivered'=>'required',
             'delivery_time'=>'required',
             'stock_status'=>'required'

        ];
    }
}
