<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LabInstrumentRequest extends FormRequest
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
       return  ['instrument_name' => 'required',
        'date_of_purchase' => 'required',
        'supplier_company_name' => 'required',
        'warranty_period' => 'required',
        'company_name' => 'required',
        'engineer_name' => 'required',
        'email_id' => 'required',
        'phone_no' => 'required',
        'company_contact_no' => 'required',
        'po_invoice_no' => 'required',
        'instrument_photo' => '',
        'bought_from_research_project_fund_name' => 'required',
        'calibration_detail_image' => 'required_without:calibration_detail',
        'calibration_detail' => 'required_without:calibration_detail_image',
        'instrument_training_manual_protocol' => 'required',
        'instrument_working_status' => 'required',
        'instrument_periodical_service_date' => 'required',
    ];
    }
}
