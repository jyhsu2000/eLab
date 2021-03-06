@extends('layouts.base')

@section('title', '成員管理')

@section('buttons')
    <a href="{{ route('member.index') }}" class="btn btn-secondary">
        <i class="fa fa-arrow-left" aria-hidden="true"></i> 成員清單
    </a>
    @if(Laratrust::can('user-profile.manage'))
        <a href="{{ route('user-profile.create') }}" class="btn btn-secondary">
            <i class="fa fa-plus-circle" aria-hidden="true"></i> 建立成員
        </a>
    @endif
    @if(Auth::check())
        <a href="{{ route('my-user-profile.index') }}" class="btn btn-primary">
            <i class="fa fa-user" aria-hidden="true"></i> 我的資料
        </a>
    @endif
@endsection

@section('main_content')
    <div class="card">
        <div class="card-body">
            {!! $dataTable->table() !!}
        </div>
    </div>
@endsection

@section('js')
    {!! $dataTable->scripts() !!}
@endsection
