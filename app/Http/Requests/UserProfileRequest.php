<?php

namespace App\Http\Requests;

use App\UserProfile;
use Illuminate\Foundation\Http\FormRequest;

class UserProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //TODO: 權限
        /** @var UserProfile $userProfile */
        $userProfile = $this->route('user_profile');
        if ($userProfile) {
            if (!\Laratrust::owns($userProfile) && !true) {
                return false;
            }
        }

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
            'user_id' => 'nullable|exists:users,id',
            'name'    => 'required',
            'email'   => 'nullable|email',
            'link'    => 'nullable|url',
        ];
    }
}
