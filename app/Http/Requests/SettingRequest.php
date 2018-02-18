<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'lab_name'           => 'nullable',
            'lab_full_name'      => 'nullable',
            'background_title'   => 'nullable|image',
            'background_intro'   => 'nullable|image',
            'background_teacher' => 'nullable|image',
            'background_member'  => 'nullable|image',
        ];
    }
}
