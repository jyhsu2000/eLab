@extends('layouts.base')

@section('title', '編輯研究計畫')

@section('buttons')
    <a href="{{ route('research-project.index') }}" class="btn btn-secondary">
        <i class="fa fa-arrow-left" aria-hidden="true"></i> 研究計畫
    </a>
@endsection

@section('main_content')
    <div class="card">
        <div class="card-body">
            {{ bs()->openForm('patch', route('research-project.update', $researchProject), ['files' => true, 'model' => $researchProject]) }}
            @include('research-project.form')

            <div class="row">
                <div class="mx-auto">
                    {{ bs()->submit('確認', 'primary')->prependChildren(fa()->icon('check')->addClass('mr-2')) }}
                </div>
            </div>
            {{ bs()->closeForm() }}
        </div>
    </div>
@endsection
