{{ bs()->formGroup(bs()->text('name')->required())->label('計畫名稱')->showAsRow() }}
{{ bs()->formGroup(bs()->text('job'))->label('擔任工作')->showAsRow() }}
{{ bs()->formGroup(bs()->text('date_range'))->label('起迄年月')->showAsRow() }}
{{ bs()->formGroup(bs()->text('subsidy_agency'))->label('補助機構')->showAsRow() }}
