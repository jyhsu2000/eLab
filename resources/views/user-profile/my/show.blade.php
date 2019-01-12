@extends('layouts.base')

@section('title', $userProfile->name)

@section('buttons')
    <a href="{{ route('my-user-profile.create-or-edit') }}" class="btn btn-primary">
        <i class="fa fa-edit" aria-hidden="true"></i> 編輯資料
    </a>
@endsection

@section('main_content')
    @include('user-profile.info')
@endsection
