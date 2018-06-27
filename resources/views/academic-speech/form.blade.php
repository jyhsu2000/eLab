{{ bs()->formGroup(bs()->text('title')->required())->label('演講題目')->showAsRow() }}
{{ bs()->formGroup(bs()->text('location'))->label('地點')->showAsRow() }}
{{ bs()->formGroup(bs()->text('date'))->label('日期')->showAsRow() }}
