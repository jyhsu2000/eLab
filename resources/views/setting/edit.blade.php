@extends('layouts.base')

@section('title', '網站設定')

@section('main_content')
    <div class="card">
        {{ bs()->openForm('patch', route('setting.update'), ['files' => true, 'model' => $setting]) }}
        <div class="card-body">
            <h5 class="card-title">網站設定</h5>
            {{ bs()->formGroup(bs()->text('lab_name')->placeholder('顯示於左上角，如：ISLab'))->label('實驗室簡稱')->showAsRow() }}
            {{ bs()->formGroup(bs()->text('lab_full_name')->placeholder('顯示於首頁、頁尾及標題，如：逢甲大學 安全實驗室'))->label('實驗室全名')->showAsRow() }}
        </div>
        <div class="card-body">
            <h5 class="card-title">首頁背景</h5>
            {{-- TODO: 設定項目 --}}
        </div>
        <div class="card-body">
            <h5 class="card-title">實驗室</h5>
            {{-- TODO: 設定項目 --}}
        </div>
        <div class="card-body">
            <h5 class="card-title">指導教授</h5>
            {{-- TODO: 設定項目 --}}
        </div>
        <div class="card-body">
            <div class="row">
                <div class="mx-auto">
                    {{ bs()->submit('更新設定', 'primary')->prependChildren(fa()->icon('check')->addClass('mr-2')) }}
                </div>
            </div>
        </div>
        {{ bs()->closeForm() }}
    </div>
@endsection
