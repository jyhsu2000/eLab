<div class="img-thumbnail"
     style="height: 80px; width: 80px; display: inline-block; background: url('{{ $userProfile->photoUrl }}'); background-size: contain; vertical-align: middle"></div>
<div style="display: inline-block; vertical-align: middle">
    {{ link_to_route('user-profile.show', $userProfile->name, $userProfile) }}
    @if($userProfile->nickname)
        <br/>（{{ $userProfile->nickname }}）
    @endif
    @if(Laratrust::can('user.view') || Laratrust::can('user.manage'))
        @if($userProfile->user)
            <br/><i class="fa fa-user" aria-hidden="true"></i>
            <a href="{{ route('user.show', $userProfile->user) }}">{{ $userProfile->user->name }}</a>
        @endif
    @endif
</div>
