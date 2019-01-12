@extends('layouts.base')

@section('title', $userProfile->name)

@section('buttons')
    <a href="{{ route('member.index') }}" class="btn btn-secondary">
        <i class="fa fa-arrow-left" aria-hidden="true"></i> 成員清單
    </a>
@endsection

@section('main_content')
    @include('user-profile.info')
@endsection
