@extends('layouts.base')

@section('title', '編輯資料')

@section('buttons')
    <a href="{{ route('my-user-profile.index') }}" class="btn btn-secondary">
        <i class="fa fa-arrow-left" aria-hidden="true"></i> 檢視資料
    </a>
@endsection

@section('main_content')
    <div class="card">
        <div class="card-body">
            {{ bs()->openForm('patch', route('my-user-profile.store-or-update'), ['files' => true, 'model' => $userProfile]) }}
            @include('user-profile.common-form')

            <div class="row">
                <div class="mx-auto">
                    {{ bs()->submit('編輯資料', 'primary')->prependChildren(fa()->icon('check')->addClass('mr-2')) }}
                </div>
            </div>
            {{ bs()->closeForm() }}
        </div>
    </div>
@endsection
