<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class RequireOneField implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
    }

    public function passes($attribute, $value)
    {
        // Check if at least one of the fields is filled
        return request('calibration_detail_image') || request('calibration_detail');
    }

    public function message()
    {
        return 'At least one of the fields (calibration_detail_image or calibration_detail) is required.';
    }
}
