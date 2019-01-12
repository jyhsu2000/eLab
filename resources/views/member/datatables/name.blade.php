<div class="img-thumbnail"
     style="height: 80px; width: 80px; display: inline-block; background: url('{{ $userProfile->photoUrl }}') no-repeat center; background-size: contain; vertical-align: middle"></div>
<div style="display: inline-block; vertical-align: middle">
    {{ link_to_route('member.show', $userProfile->name, $userProfile) }}
    @if($userProfile->nickname)
        <br/>（{{ $userProfile->nickname }}）
    @endif
</div>
