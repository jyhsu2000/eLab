<div class="alert alert-warning">
    請注意，以下項目資訊皆為公開資訊，將直接顯示於網站
</div>
@if(isset($userProfile))
    <div class="row form-group">
        <label class="col-form-label col-sm-2" for="photo">原相片</label>
        <div class="col-sm-10 form-control-plaintext">
            @if($userProfile->photoUrl)
                <img src="{{ $userProfile->photoUrl }}" class="img-thumbnail"
                     style="max-height: 200px; max-width: 200px"/>
                {{ bs()->checkBox('delete_photo', '刪除相片') }}
            @else
                無
            @endif
        </div>
    </div>
@endif
{{ bs()->formGroup(bs()->file('photo')->acceptImage())->label('新相片')->helpText('若不打算更換，則無需選擇檔案')->showAsRow() }}
{{ bs()->formGroup(bs()->input('number', 'in_year')->placeholder('請填寫學年度（如學號開頭m04，入學年度為104）'))->label('入學年度')->showAsRow() }}
{{ bs()->formGroup(bs()->input('number', 'graduate_year')->placeholder('請填寫學年度（如106學年度第二學期畢業，畢業年度為106）'))->label('畢業年度')->showAsRow() }}
{{ bs()->formGroup(bs()->checkBox('in_school', '在學中'))->label('在學狀態')->showAsRow() }}
<div class="row form-group">
    <label class="col-form-label col-sm-2" for="type">身分</label>
    <div class="col-sm-10">
        <div class="input-group">
            {{ bs()->text('type') }}
            <div class="input-group-append">
                <span class="input-group-text">快速填寫：</span>
                @foreach(['教授', '碩士班', '博士班', '碩專班'] as $type)
                    <button class="btn btn-outline-secondary" type="button" onclick="auto_fill_type('{{ $type }}')">{{ $type }}</button>
                @endforeach
            </div>
        </div>
    </div>
</div>
{{ bs()->formGroup(bs()->text('name')->required())->label('姓名')->showAsRow() }}
{{ bs()->formGroup(bs()->text('nickname'))->label('暱稱')->showAsRow() }}
{{ bs()->formGroup(bs()->textarea('info')->attribute('rows', 10))->label('個人簡介')->showAsRow() }}
<div class="alert alert-warning">
    以下為聯絡資訊，可逐一調整顯示設定，若非公開顯示，則僅有實驗室成員可見
</div>
@foreach($contactTypes as $contactType)
    <div class="row form-group">
        <label class="col-form-label col-sm-2" for="contact_{{ $contactType->id }}">{{ $contactType->name }}</label>
        <div class="col-sm-10">
            <div class="input-group">
                @if($contactType->is_url)
                    {{ bs()->input('url', 'contact_'.$contactType->id, optional($contactInfos->get($contactType->id))->content) }}
                @else
                    {{ bs()->text('contact_'.$contactType->id, optional($contactInfos->get($contactType->id))->content) }}
                @endif
                <div class="input-group-append">
                    <div class="input-group-text">
                        {{ bs()->checkBox('is_public_'.$contactType->id, '公開顯示', optional($contactInfos->get($contactType->id))->is_public !== false) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

@section('js')
    @parent
    <script>
        $('#user_id').select2();
        var auto_fill_type = function(type){
            $('#type').val(type);
        }
    </script>
@endsection
