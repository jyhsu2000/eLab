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

                <dt class="col-4 col-md-3">個人簡介</dt>
                <dd class="col-8 col-md-9">{!! nl2br(e($userProfile->info)) !!}</dd>
            </dl>
            <hr>
            <dl class="row" style="font-size: 120%">
                @foreach($contactInfos as $contactInfo)
                    <dt class="col-4 col-md-3">
                        <i class="{{ $contactInfo->contactType->icon_class }}"></i>
                        {{ $contactInfo->contactType->name }}
                    </dt>
                    <dd class="col-8 col-md-9">
                        @if(!$contactInfo->is_public)
                            <i class="fas fa-lock text-muted" title="僅實驗室成員可見"></i>
                        @endif
                        @if($contactInfo->contactType->is_url)
                            <a href="{{ $contactInfo->content }}" target="_blank">{{ $contactInfo->content }}</a>
                        @else
                            {{ $contactInfo->content }}
                        @endif
                    </dd>
                @endforeach
            </dl>
            <hr>
            <h4 class="card-title">
                工作經歷/任職公司
                <a href="{{ route('job-experience.create', ['user-profile' => $userProfile->id]) }}" class="btn btn-primary btn-sm">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i> 新增
                </a>
            </h4>
            <ul>
                {{-- TODO: 工作經歷 --}}
                <li>xxxx (19xx-xx ~ 20xx)</li>
                <li>xxxx (20xx-xx-xx ~ 20xx)</li>
                <li>xxxx (20xx ~ )</li>
            </ul>
        </div>
    </div>
@endsection
