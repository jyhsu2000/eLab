@extends('layouts.base')

@section('title', '編輯成員')

@section('buttons')
    <a href="{{ route('user-profile.show', $userProfile) }}" class="btn btn-secondary">
        <i class="fa fa-arrow-left" aria-hidden="true"></i> 檢視成員
    </a>
@endsection

@section('main_content')
    <div class="card">
        <div class="card-body">
            {{ bs()->openForm('patch', route('user-profile.update', $userProfile), ['files' => true, 'model' => $userProfile]) }}
            @include('user-profile.form')

            <div class="row">
                <div class="mx-auto">
                    {{ bs()->submit('編輯成員', 'primary')->prependChildren(fa()->icon('check')->addClass('mr-2')) }}
                </div>
            </div>
            {{ bs()->closeForm() }}
        </div>
    </div>
@endsection
