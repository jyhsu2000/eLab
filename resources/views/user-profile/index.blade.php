@extends('layouts.base')

@section('title', '成員清單')

@section('buttons')
    @if($user)
        <a href="{{ route('user-profile.create') }}" class="btn btn-secondary">
            <i class="fa fa-plus-circle" aria-hidden="true"></i> 建立成員
        </a>
        @if($user->userProfile)
            <a href="{{ route('user-profile.show', $user->userProfile) }}" class="btn btn-primary">
                <i class="fa fa-user" aria-hidden="true"></i> 我的資料
            </a>
        @endif
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
