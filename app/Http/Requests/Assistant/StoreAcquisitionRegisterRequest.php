<?php

namespace App\Http\Requests\Assistant;

use Illuminate\Foundation\Http\FormRequest;

class StoreAcquisitionRegisterRequest extends FormRequest
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
        return [
            'district_id'=>'required',
            'taluka_id'=>'required',
            'village_id'=>'required',
            'sr_no'=>'required',
            'land_acquisition_id'=>'required',
           'bundle'=>'required',

        ];
    }
}
