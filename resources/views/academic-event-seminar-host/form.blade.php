{{ bs()->formGroup(bs()->text('agenda_name')->required())->label('會議名稱')->showAsRow() }}
{{ bs()->formGroup(bs()->text('date'))->label('會議時間')->showAsRow() }}
{{ bs()->formGroup(bs()->text('location'))->label('會議地點')->showAsRow() }}
