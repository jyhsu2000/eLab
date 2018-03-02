<div class="row form-group">
    <label class="col-form-label col-sm-2" for="photo">個人資料</label>
    <div class="col-sm-10 form-control-plaintext">
        {{ link_to_route('user-profile.show', $userProfile->name, $userProfile) }}
    </div>
</div>
{{ bs()->formGroup(bs()->text('content')->required())->label('工作內容')->showAsRow() }}
{{ bs()->formGroup(bs()->checkBox('is_public', '公開顯示'))->label(' ')->showAsRow() }}
{{-- TODO: 日期 --}}
