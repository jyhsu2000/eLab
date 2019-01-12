@if(Laratrust::can('user-profile.manage'))
    {{ bs()->formGroup(bs()->select('user_id')->options(\App\User::getOptions()))->label('使用者')->showAsRow() }}
@else
    {{ bs()->formGroup(bs()->select('user_id')->options(\App\User::getOptions())->disabled())->label('使用者')->showAsRow() }}
@endif
{{ bs()->formGroup(bs()->checkBox('is_member', '該成員為實驗室成員'))->label('實驗室成員')->showAsRow() }}
@include('user-profile.common-form')
