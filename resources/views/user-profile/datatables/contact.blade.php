<ul class="list-unstyled">
    @foreach($userProfile->contactInfos as $contactInfo)
        @if($contactInfo->is_public || Laratrust::can('user-profile.manage') || optional(auth()->user())->is_member)
            <li>
                <i class="{{ $contactInfo->contactType->icon_class }}" aria-hidden="true"
                   title="{{ $contactInfo->contactType->name }}"></i>
                @if(!$contactInfo->is_public)
                    <i class="fas fa-lock text-muted" title="僅實驗室成員可見"></i>
                @endif
                @if($contactInfo->contactType->is_url)
                    <a href="{{ $contactInfo->content }}"
                       target="_blank">{{ str_limit($contactInfo->content, 30, '...') }}</a>
                @else
                    {{ $contactInfo->content }}
                @endif
            </li>
        @endif
    @endforeach
</ul>
