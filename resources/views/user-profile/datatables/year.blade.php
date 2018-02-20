@if($userProfile->in_year || $userProfile->graduate_year)
    {{ $userProfile->in_year }}
    ~
    {{ $userProfile->graduate_year }}
@endif
@if($userProfile->in_school)
    <br>
    <span class="badge badge-primary">
        在學中
    </span>
@endif
