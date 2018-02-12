<ul class="list-unstyled">
    @foreach($userProfile->contactInfos as $contactInfo)
        <li>
            <i class="{{ $contactInfo->contactType->icon_class }}" aria-hidden="true"
               title="{{ $contactInfo->contactType->name }}"></i>
            @if($contactInfo->contactType->is_url)
                <a href="{{ $contactInfo->content }}" target="_blank">{{ str_limit($contactInfo->content, 30, '...') }}</a>
            @else
                {{ $contactInfo->content }}
            @endif
        </li>
    @endforeach
</ul>
