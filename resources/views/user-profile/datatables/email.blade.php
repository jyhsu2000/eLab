<ul class="list-unstyled">
    @if($email)
        <li><i class="fa fa-fw fa-envelope-o" aria-hidden="true" title="聯絡信箱"></i> {{ $email }}</li> @endif
    @if($office_phone)
        <li><i class="fa fa-fw fa-phone" aria-hidden="true" title="工作電話"></i> {{ $office_phone }}</li> @endif
    @if($home_phone)
        <li><i class="fa fa-fw fa-home" aria-hidden="true" title="家裡電話"></i> {{ $home_phone }}</li> @endif
    @if($cell_phone)
        <li><i class="fa fa-fw fa-mobile" aria-hidden="true" title="手機"></i> {{ $cell_phone }}</li> @endif
    @if($link)
        <li><i class="fa fa-fw fa-link" aria-hidden="true" title="個人網址"></i>
            <a href="{{ $link }}" target="_blank">{{ str_limit($link, 30, '...') }}</a></li> @endif
</ul>
