<div class="row form-group">
    <label class="col-form-label col-sm-2" for="photo">個人資料</label>
    <div class="col-sm-10 form-control-plaintext">
        {{ link_to_route('user-profile.show', $userProfile->name, $userProfile) }}
        {{ bs()->hidden('user_profile_id', $userProfile->id) }}
    </div>
</div>
{{ bs()->formGroup(bs()->text('content')->required())->label('工作內容')->showAsRow() }}
{{ bs()->formGroup(bs()->checkBox('is_public', '公開顯示'))->label(' ')->showAsRow() }}
<div class="row form-group">
    <label class="col-form-label col-sm-2" for="photo">開始時間</label>
    <div class="col-sm-10 date-select">
        {{ bs()->select('start_year', $options['year']) }}
        {{ bs()->select('start_month', $options['month']) }}
        {{ bs()->select('start_day', $options['day']) }}
    </div>
</div>
<div class="row form-group">
    <label class="col-form-label col-sm-2" for="photo">結束時間</label>
    <div class="col-sm-10 date-select">
        {{ bs()->select('end_year', $options['year']) }}
        {{ bs()->select('end_month', $options['month']) }}
        {{ bs()->select('end_day', $options['day']) }}
    </div>
</div>

@section('css')
    @parent
    <style>
        .date-select > select {
            display: inline-block;
            width: 200px;
        }
    </style>
@endsection

@section('js')
    @parent
    <script src="{{ asset('js/jquery.dateSelectBoxes.js') }}"></script>
    <script>
        $(function () {
            $().dateSelectBoxes({
                yearElement: $('#start_year'),
                monthElement: $('#start_month'),
                dayElement: $('#start_day'),
                yearLabel: '年',
                monthLabel: '月',
                dayLabel: '日',
                keepLabels: false
            });
            $().dateSelectBoxes({
                yearElement: $('#end_year'),
                monthElement: $('#end_month'),
                dayElement: $('#end_day'),
                yearLabel: '年',
                monthLabel: '月',
                dayLabel: '日',
                keepLabels: false
            });
        })
    </script>
@endsection
