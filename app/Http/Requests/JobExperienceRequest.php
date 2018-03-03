<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobExperienceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'content'     => 'required',
            'start_year'  => 'nullable|integer',
            'start_month' => 'nullable|integer|min:0|max:12',
            'start_day'   => 'nullable|integer|min:0|max:31',
            'end_year'    => 'nullable|integer',
            'end_month'   => 'nullable|integer|min:0|max:12',
            'end_day'     => 'nullable|integer|min:0|max:31',
        ];
    }
}
