@extends('layouts.base')

@section('title', '網站設定')

@section('main_content')
    <div class="card">
        {{ bs()->openForm('patch', route('setting.update'), ['files' => true, 'model' => $setting]) }}
        <div class="card-body">
            <h5 class="card-title">網站設定</h5>
            {{ bs()->formGroup(bs()->text('lab_name')->placeholder('顯示於左上角，如：ISLab'))->label('實驗室簡稱')->showAsRow() }}
            {{ bs()->formGroup(bs()->text('lab_full_name')->placeholder('顯示於首頁、頁尾及標題，如：逢甲大學 資訊安全實驗室'))->label('實驗室全名')->showAsRow() }}
        </div>
        <div class="card-body">
            <h5 class="card-title">首頁背景</h5>
            <div class="row">
                @foreach($backgroundSettingItems as $key => $name)
                    <div class="card col-3">
                        <div class="card-body">
                            <p class="card-title">{{ $name }}</p>
                        </div>
                        <div class="card-body text-center">
                            @if($fileUrl = optional($independentFiles->get('background_'.$key))->file_url)
                                <div class="img-thumbnail d-inline-flex justify-content-center"
                                     style="width: 160px; height: 160px; background: url('{{ $fileUrl }}') no-repeat center center / contain"></div>
                                {{ bs()->checkBox('delete_background_'.$key, '刪除圖片') }}
                            @else
                                <div class="img-thumbnail d-inline-flex justify-content-center"
                                     style="height: 160px; width: 160px; background-image: repeating-linear-gradient(-45deg, #dddddd 0px, #dddddd 25px, transparent 25px, transparent 50px, #dddddd 50px);">
                                    <div class="align-self-center">未設定</div>
                                </div>
                            @endif
                        </div>
                        <div class="card-body">
                            {{ bs()->formGroup(bs()->file('background_'.$key)->acceptImage())->helpText('若不打算更換，則無需選擇檔案') }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="card-body">
            <h5 class="card-title">實驗室</h5>
            {{ bs()->formGroup(bs()->textarea('lab_intro')->attribute('rows', 10))->label('簡介')->showAsRow() }}
        </div>
        <div class="card-body">
            <h5 class="card-title">指導教授</h5>
            {{ bs()->formGroup(bs()->text('teacher_name'))->label('姓名與職稱')->showAsRow() }}
            @if($fileUrl = optional($independentFiles->get('teacher_photo'))->file_url)
                <div class="row form-group">
                    <label class="col-form-label col-sm-2" for="photo">原相片</label>
                    <div class="col-sm-10 form-control-plaintext">
                        <img src="{{ $fileUrl }}" class="img-thumbnail"
                             style="max-height: 200px; max-width: 200px"/>
                        {{ bs()->checkBox('delete_teacher_photo', '刪除相片') }}
                    </div>
                </div>
            @endif
            {{ bs()->formGroup(bs()->file('teacher_photo')->acceptImage())->label('相片')->helpText('若不打算更換，則無需選擇檔案')->showAsRow() }}

            {{ bs()->formGroup(bs()->textarea('teacher_info')->attribute('rows', 10))->label('簡介')->showAsRow() }}
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

@section('js')
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            language: 'zh_TW',
            branding: false,
            plugins: 'autolink image link table hr advlist lists textcolor colorpicker help',
            // plugins: 'print preview fullpage searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern help',
            toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
            image_advtab: true,
        });
    </script>
@endsection
