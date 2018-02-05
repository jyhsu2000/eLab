<div class="img-thumbnail"
     style="height: 80px; width: 80px; display: inline-block; background: url('{{ $avatar_path }}'); vertical-align: middle"></div>
<div style="display: inline-block; vertical-align: middle">
    {{ link_to_route('user-profile.show', $name, $id) }}
    @if($nickname)
        <br/>（{{ $nickname }}）
    @endif
</div>
