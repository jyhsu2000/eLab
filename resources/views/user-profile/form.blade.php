{{ bs()->formGroup(bs()->select('user_id')->options(\App\User::getOptions()))->label('使用者')->showAsRow() }}
{{ bs()->formGroup(bs()->checkBox('is_member', '該成員為實驗室成員（顯示於網站上）'))->label('實驗室成員')->showAsRow() }}
@include('user-profile.common-form')

@section('js')
    @parent
    <script>
        $('#user_id').select2();
    </script>
@endsection
