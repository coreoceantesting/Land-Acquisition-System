<?php

namespace App\Http\Requests\Assistant;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAcquisitionAssistantRequest extends FormRequest
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
            'district_id' => 'required',
            'taluka_id' => 'required',
            'village_id' => 'required',
            'sr_no_id' => 'required',
            'land_acquisition_id' => 'required',
            'project_name' => 'required',
            'year_id' => 'required',
            'acquisition_board_name' => 'required',
            'description' => 'nullable',
            'designation' => 'required',
            'acquisition_proposal' => 'required',
            'law' => 'required',
            // 'survey_or_group'=>'required',
            // 'number'=>'required',
            // 'area'=>'required'

        ];
    }
}
