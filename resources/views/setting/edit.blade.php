@extends('layouts.base')

@section('title', '網站設定')

@section('main_content')
    <div class="card">
        <div class="card-body">
            {{ bs()->openForm('patch', route('setting.update'), ['files' => true]) }}
            {{-- TODO: 設定項目 --}}

            <div class="row">
                <div class="mx-auto">
                    {{ bs()->submit('更新設定', 'primary')->prependChildren(fa()->icon('check')->addClass('mr-2')) }}
                </div>
            </div>
            {{ bs()->closeForm() }}
        </div>
    </div>
@endsection
