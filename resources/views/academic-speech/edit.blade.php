@extends('layouts.base')

@section('title', '編輯紀錄')

@section('buttons')
    <a href="{{ route('academic-speech.index') }}" class="btn btn-secondary">
        <i class="fa fa-arrow-left" aria-hidden="true"></i> 學術演講
    </a>
@endsection

@section('main_content')
    <div class="card">
        <div class="card-body">
            {{ bs()->openForm('patch', route('academic-speech.update', $academicSpeech), ['files' => true, 'model' => $academicSpeech]) }}
            @include('academic-speech.form')

            <div class="row">
                <div class="mx-auto">
                    {{ bs()->submit('確認', 'primary')->prependChildren(fa()->icon('check')->addClass('mr-2')) }}
                </div>
            </div>
            {{ bs()->closeForm() }}
        </div>
    </div>
@endsection
