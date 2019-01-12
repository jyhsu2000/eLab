@extends('layouts.base')

@section('title', $userProfile->name)

@section('buttons')
    <a href="{{ route('my-user-profile.create-or-edit') }}" class="btn btn-primary">
        <i class="fa fa-edit" aria-hidden="true"></i> 編輯資料
    </a>
@endsection

@section('main_content')
    @if(!$userProfile->is_member)
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-triangle mr-2"></i>此資料目前不會顯示於網站上，請告知管理員將您標示為<strong>實驗室成員</strong>
        </div>
    @endif
    @include('user-profile.info')
@endsection
