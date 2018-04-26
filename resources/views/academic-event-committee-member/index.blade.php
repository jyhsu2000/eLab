@extends('layouts.base')

@section('title', '應聘擔任國內重要委員會委員')

@section('buttons')
    @if(Laratrust::can('setting.manage'))
        <a href="{{ route('academic-event-committee-member.create') }}" class="btn btn-secondary">
            <i class="fa fa-plus-circle" aria-hidden="true"></i> 建立
        </a>
    @endif
@endsection

@section('main_content')
    <div class="card">
        <div class="card-body">
            {!! $dataTable->table() !!}
        </div>
    </div>
@endsection

@section('js')
    {!! $dataTable->scripts() !!}
@endsection
