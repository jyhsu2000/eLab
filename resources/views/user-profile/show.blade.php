@extends('layouts.base')

@section('title', $userProfile->name)

@section('buttons')
    <a href="{{ route('user-profile.index') }}" class="btn btn-secondary">
        <i class="fa fa-arrow-left" aria-hidden="true"></i> 成員清單
    </a>
    @if(Laratrust::owns($userProfile) || Laratrust::can('user-profile.manage'))
        <a href="{{ route('user-profile.edit', $userProfile) }}" class="btn btn-primary">
            <i class="fa fa-edit" aria-hidden="true"></i> 編輯
        </a>
    @endif
    @if(Laratrust::can('user-profile.manage'))
        {!! Form::open(['route' => ['user-profile.destroy', $userProfile], 'style' => 'display: inline', 'method' => 'DELETE', 'onSubmit' => "return confirm('確定要刪除嗎？');"]) !!}
        <button type="submit" class="btn btn-danger">
            <i class="fa fa-trash" aria-hidden="true"></i> 刪除
        </button>
        {!! Form::close() !!}
    @endif
@endsection

@section('main_content')
    <div class="card">
        <div class="card-body text-center">
            @if($userProfile->photoUrl)
                <img src="{{ $userProfile->photoUrl }}" class="img-thumbnail"
                     style="max-height: 600px; max-width: 600px"/>
            @else
                <div class="img-thumbnail d-inline-flex justify-content-center"
                     style="height: 200px; width: 200px; background-image: repeating-linear-gradient(-45deg, #dddddd 0px, #dddddd 25px, transparent 25px, transparent 50px, #dddddd 50px);">
                    <div class="align-self-center">無相片</div>
                </div>
            @endif
        </div>
        <div class="card-body">
            <dl class="row" style="font-size: 120%">
                @if(Laratrust::can('user.view') || Laratrust::can('user.manage'))
                    <dt class="col-4 col-md-3">會員</dt>
                    <dd class="col-8 col-md-9">
                        @if($userProfile->user)
                            {{ link_to_route('user.show', $userProfile->user->name, $userProfile->user) }}
                        @else
                            <span class="text-muted">未連結</span>
                        @endif
                    </dd>
                @endif

                <dt class="col-4 col-md-3">入學年度</dt>
                <dd class="col-8 col-md-9">{{ $userProfile->in_year }}</dd>

                <dt class="col-4 col-md-3">畢業年度</dt>
                <dd class="col-8 col-md-9">{{ $userProfile->graduate_year }}</dd>

                <dt class="col-4 col-md-3">在學狀態</dt>
                <dd class="col-8 col-md-9">{{ $userProfile->in_school ? '在學中' : '非在學' }}</dd>

                <dt class="col-4 col-md-3">類型</dt>
                <dd class="col-8 col-md-9">{{ $userProfile->type }}</dd>

                <dt class="col-4 col-md-3">姓名</dt>
                <dd class="col-8 col-md-9">{{ $userProfile->name }}</dd>

                <dt class="col-4 col-md-3">暱稱</dt>
                <dd class="col-8 col-md-9">{{ $userProfile->nickname }}</dd>

                <dt class="col-4 col-md-3">聯絡信箱</dt>
                <dd class="col-8 col-md-9">{{ $userProfile->email }}</dd>

                <dt class="col-4 col-md-3">工作電話</dt>
                <dd class="col-8 col-md-9">{{ $userProfile->office_phone }}</dd>

                <dt class="col-4 col-md-3">家裡電話</dt>
                <dd class="col-8 col-md-9">{{ $userProfile->home_phone }}</dd>

                <dt class="col-4 col-md-3">手機</dt>
                <dd class="col-8 col-md-9">{{ $userProfile->cell_phone }}</dd>

                <dt class="col-4 col-md-3">個人網址</dt>
                <dd class="col-8 col-md-9">
                    @if($userProfile->link)
                        <a href="{{ $userProfile->link }}" target="_blank">{{ $userProfile->link }}</a>
                    @endif
                </dd>

                <dt class="col-4 col-md-3">個人簡介</dt>
                <dd class="col-8 col-md-9">{!! nl2br(e($userProfile->info)) !!}</dd>
            </dl>
        </div>
    </div>
@endsection
