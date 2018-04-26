@extends('layouts.base')

@section('title', '編輯紀錄')

@section('buttons')
    <a href="{{ route('academic-event-paper-committee.index') }}" class="btn btn-secondary">
        <i class="fa fa-arrow-left" aria-hidden="true"></i> 擔任國內外學術期刊編輯委員
    </a>
@endsection

@section('main_content')
    <div class="card">
        <div class="card-body">
            {{ bs()->openForm('patch', route('academic-event-paper-committee.update', $academicEventPaperCommittee), ['files' => true, 'model' => $academicEventPaperCommittee]) }}
            @include('academic-event-paper-committee.form')

            <div class="row">
                <div class="mx-auto">
                    {{ bs()->submit('確認', 'primary')->prependChildren(fa()->icon('check')->addClass('mr-2')) }}
                </div>
            </div>
            {{ bs()->closeForm() }}
        </div>
    </div>
@endsection
