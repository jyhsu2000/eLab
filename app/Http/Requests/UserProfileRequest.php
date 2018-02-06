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
        /** @var UserProfile $userProfile */
        $userProfile = $this->route('user_profile');
        //自己的資料
        if ($userProfile && \Laratrust::owns($userProfile)) {
            return true;
        }
        //具有管理權限
        if (\Laratrust::can('user-profile.manage')) {
            return true;
        }

        return false;
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
