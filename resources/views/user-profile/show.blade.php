@extends('layouts.base')

@section('title', $userProfile->name)

@section('buttons')
    <a href="{{ route('user-profile.index') }}" class="btn btn-secondary">
        <i class="fa fa-arrow-left" aria-hidden="true"></i> 成員管理
    </a>
    @if(Laratrust::owns($userProfile))
        <a href="{{ route('my-user-profile.create-or-edit') }}" class="btn btn-primary">
            <i class="fa fa-edit" aria-hidden="true"></i> 編輯資料
        </a>
    @endif
    @if(Laratrust::can('user-profile.manage'))
        <a href="{{ route('user-profile.edit', $userProfile) }}" class="btn btn-primary">
            <i class="fa fa-edit" aria-hidden="true"></i> 編輯
        </a>
        {!! Form::open(['route' => ['user-profile.destroy', $userProfile], 'style' => 'display: inline', 'method' => 'DELETE', 'onSubmit' => "return confirm('確定要刪除嗎？');"]) !!}
        <button type="submit" class="btn btn-danger">
            <i class="fa fa-trash" aria-hidden="true"></i> 刪除
        </button>
        {!! Form::close() !!}
    @endif
@endsection

@section('main_content')
    @if(Laratrust::can('user.view') || Laratrust::can('user.manage') || Laratrust::can('user-profile.manage'))
        <div class="card mb-2">
            <div class="card-body">
                <dl class="row mb-0" style="font-size: 120%">
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
                    @if(Laratrust::can('user-profile.manage'))
                        <dt class="col-4 col-md-3">實驗室成員</dt>
                        <dd class="col-8 col-md-9">
                            @if($userProfile->is_member)
                                <i class="fas fa-check text-success"></i>
                            @else
                                <i class="fas fa-times text-danger"></i>
                            @endif
                        </dd>
                    @endif
                </dl>
            </div>
        </div>
    @endif
    @include('user-profile.info')
@endsection
