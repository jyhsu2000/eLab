@extends('layouts.base')

@section('title', '建立成員')

@section('buttons')
    <a href="{{ route('user-profile.index') }}" class="btn btn-secondary">
        <i class="fa fa-arrow-left" aria-hidden="true"></i> 通訊錄
    </a>
@endsection

@section('main_content')
    <div class="card">
        <div class="card-body">
            {{ bs()->openForm('post', route('user-profile.store'), ['files' => true]) }}
            @include('user-profile.form')

            <div class="row">
                <div class="mx-auto">
                    {{ bs()->submit('建立成員', 'primary')->prependChildren(fa()->icon('check')->addClass('mr-2')) }}
                </div>
            </div>
            {{ bs()->closeForm() }}
        </div>
    </div>
@endsection
