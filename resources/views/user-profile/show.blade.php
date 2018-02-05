@extends('layouts.base')

@section('title', $userProfile->name)

@section('buttons')
    <a href="{{ route('user-profile.index') }}" class="btn btn-secondary">
        <i class="fa fa-arrow-left" aria-hidden="true"></i> 通訊錄
    </a>
    {{-- TODO: 權限 --}}
    <a href="{{ route('user-profile.edit', $userProfile) }}" class="btn btn-primary">
        <i class="fa fa-pencil-square-o" aria-hidden="true"></i> 編輯
    </a>
    {!! Form::open(['route' => ['user-profile.destroy', $userProfile], 'style' => 'display: inline', 'method' => 'DELETE', 'onSubmit' => "return confirm('確定要刪除嗎？');"]) !!}
    <button type="submit" class="btn btn-danger">
        <i class="fa fa-trash" aria-hidden="true"></i> 刪除
    </button>
    {!! Form::close() !!}
@endsection

@section('main_content')
    <div class="card">
        <div class="card-body text-center">
            {{-- TODO: 大頭貼 --}}
            <img src="{{ $userProfile->avatar_path }}" class="img-thumbnail"
                 style="max-height: 200px; max-width: 200px"/>
        </div>
        <div class="card-body">
            <dl class="row" style="font-size: 120%">
                <dt class="col-4 col-md-3">入學年度</dt>
                <dd class="col-8 col-md-9">{{ $userProfile->in_year }}</dd>

                <dt class="col-4 col-md-3">畢業年度</dt>
                <dd class="col-8 col-md-9">{{ $userProfile->graduate_year }}</dd>

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
