@extends('layouts.base')

@section('title', '編輯工作經歷')

@section('buttons')
    @if(Laratrust::owns($userProfile))
        <a href="{{ route('my-user-profile.index') }}" class="btn btn-secondary">
            <i class="fa fa-arrow-left" aria-hidden="true"></i> 檢視資料
        </a>
    @endif
    @if(Laratrust::can('user-profile.manage'))
        <a href="{{ route('user-profile.show', $userProfile) }}" class="btn btn-secondary">
            <i class="fa fa-arrow-left" aria-hidden="true"></i> 檢視成員
        </a>
    @endif
@endsection

@section('main_content')
    <div class="card">
        <div class="card-body">
            {{ bs()->openForm('patch', route('job-experience.update', $jobExperience), ['model' => $jobExperience]) }}
            @include('job-experience.form')

            <div class="row">
                <div class="mx-auto">
                    {{ bs()->submit('編輯工作經歷', 'primary')->prependChildren(fa()->icon('check')->addClass('mr-2')) }}
                </div>
            </div>
            {{ bs()->closeForm() }}
        </div>
    </div>
@endsection
