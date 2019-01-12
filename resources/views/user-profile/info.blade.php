<div class="card">
    <div class="card-body text-center">
        @if($userProfile->photoUrl)
            <img src="{{ $userProfile->photoUrl }}" class="img-thumbnail"
                 style="max-height: 600px; max-width: 600px"/>
        @else
            <div class="img-thumbnail d-inline-flex justify-content-center"
                 style="height: 200px; width: 200px; background-image: repeating-linear-gradient(-45deg, #dddddd 0px, #dddddd 25px, transparent 25px, transparent 50px, #dddddd 50px);">
                <div class="align-self-center">無相片</div>
            </div>
        @endif
    </div>
    <div class="card-body">
        <dl class="row" style="font-size: 120%">
            <dt class="col-4 col-md-3">入學年度</dt>
            <dd class="col-8 col-md-9">{{ $userProfile->in_year }}</dd>

            <dt class="col-4 col-md-3">畢業年度</dt>
            <dd class="col-8 col-md-9">{{ $userProfile->graduate_year }}</dd>

            <dt class="col-4 col-md-3">在學狀態</dt>
            <dd class="col-8 col-md-9">{{ $userProfile->in_school ? '在學中' : '非在學' }}</dd>

            <dt class="col-4 col-md-3">身分</dt>
            <dd class="col-8 col-md-9">{{ $userProfile->type }}</dd>

            <dt class="col-4 col-md-3">姓名</dt>
            <dd class="col-8 col-md-9">{{ $userProfile->name }}</dd>

            <dt class="col-4 col-md-3">暱稱</dt>
            <dd class="col-8 col-md-9">{{ $userProfile->nickname }}</dd>

            <dt class="col-4 col-md-3">個人簡介</dt>
            <dd class="col-8 col-md-9">{!! nl2br(e($userProfile->info)) !!}</dd>
        </dl>
        <hr>
        <dl class="row" style="font-size: 120%">
            @foreach($contactInfos as $contactInfo)
                <dt class="col-4 col-md-3">
                    <i class="{{ $contactInfo->contactType->icon_class }}"></i>
                    {{ $contactInfo->contactType->name }}
                </dt>
                <dd class="col-8 col-md-9">
                    @if(!$contactInfo->is_public)
                        <i class="fas fa-lock text-muted" title="僅實驗室成員可見"></i>
                    @endif
                    @if($contactInfo->contactType->is_url)
                        <a href="{{ $contactInfo->content }}" target="_blank">{{ $contactInfo->content }}</a>
                    @else
                        {{ $contactInfo->content }}
                    @endif
                </dd>
            @endforeach
        </dl>
        <hr>
        <h4 class="card-title">
            工作經歷/任職公司
            @php($jobEditMode = isset($jobEditMode) ? $jobEditMode : false)
            @if($jobEditMode && (Laratrust::owns($userProfile) || Laratrust::can('user-profile.manage')))
                <a href="{{ route('job-experience.create', ['user-profile' => $userProfile->id]) }}"
                   class="btn btn-primary btn-sm">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i> 新增
                </a>
            @endif
        </h4>
        <ul>
            @forelse($jobExperiences as $jobExperience)
                <li>
                    @if(!$jobExperience->is_public)
                        <i class="fas fa-lock text-muted" title="僅實驗室成員可見"></i>
                    @endif
                    {{ $jobExperience->content }}{{ $jobExperience->date_range }}
                    @if($jobEditMode && (Laratrust::owns($userProfile) || Laratrust::can('user-profile.manage')))
                        <a href="{{ route('job-experience.edit', $jobExperience) }}" class="btn btn-primary btn-sm">
                            <i class="fa fa-edit" aria-hidden="true" title="編輯"></i>
                        </a>
                        {!! Form::open(['route' => ['job-experience.destroy', $jobExperience], 'style' => 'display: inline', 'method' => 'DELETE', 'onSubmit' => "return confirm('確定要刪除嗎？');"]) !!}
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fa fa-trash" aria-hidden="true" title="刪除"></i>
                        </button>
                        {!! Form::close() !!}
                    @endif
                </li>
            @empty
                <li>暫無</li>
            @endforelse
        </ul>
    </div>
</div>
