{{ bs()->formGroup(bs()->select('user_id')->options(\App\User::getOptions()))->label('使用者')->showAsRow() }}
{{ bs()->formGroup(bs()->input('number', 'in_year')->placeholder('請填寫學年度（如學號開頭m04，入學年度為104）'))->label('入學年度')->showAsRow() }}
{{ bs()->formGroup(bs()->input('number', 'graduate_year')->placeholder('請填寫學年度（如106學年度第二學期畢業，畢業年度為106）'))->label('畢業年度')->showAsRow() }}
{{ bs()->formGroup(bs()->select('type')->options(\App\UserProfile::getTypeOptions()))->label('類型')->showAsRow() }}
{{ bs()->formGroup(bs()->text('name')->required())->label('姓名')->showAsRow() }}
{{ bs()->formGroup(bs()->text('nickname'))->label('暱稱')->showAsRow() }}
{{ bs()->formGroup(bs()->email('email'))->label('聯絡信箱')->showAsRow() }}
{{ bs()->formGroup(bs()->text('office_phone'))->label('工作電話')->showAsRow() }}
{{ bs()->formGroup(bs()->text('home_phone'))->label('家裡電話')->showAsRow() }}
{{ bs()->formGroup(bs()->text('cell_phone'))->label('手機')->showAsRow() }}
{{ bs()->formGroup(bs()->input('url', 'link'))->label('個人網址')->showAsRow() }}
{{ bs()->formGroup(bs()->textarea('info')->attribute('rows', 10))->label('個人簡介')->showAsRow() }}
