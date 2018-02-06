@if($user_profile)
    {{ link_to_route('user-profile.show', $user_profile['name'], $user_profile['id']) }}
    @if($user_profile['nickname'])
        <br/>（{{ $user_profile['nickname'] }}）
    @endif
@endif
