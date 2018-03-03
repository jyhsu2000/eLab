<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\JobExperience
 *
 * @property int $id
 * @property int $user_profile_id 個人資料
 * @property string $content 內容
 * @property bool $is_public 公開顯示
 * @property int|null $start_year 開始年
 * @property int|null $start_month 開始月
 * @property int|null $start_day 開始日
 * @property int|null $end_year 結束年
 * @property int|null $end_month 結束月
 * @property int|null $end_day 結束日
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read null|string $date_range
 * @property-read \App\UserProfile $userProfile
 * @method static \Illuminate\Database\Eloquent\Builder|\App\JobExperience whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\JobExperience whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\JobExperience whereEndDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\JobExperience whereEndMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\JobExperience whereEndYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\JobExperience whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\JobExperience whereIsPublic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\JobExperience whereStartDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\JobExperience whereStartMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\JobExperience whereStartYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\JobExperience whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\JobExperience whereUserProfileId($value)
 * @mixin \Eloquent
 */
class JobExperience extends Model
{
    protected $fillable = [
        'user_profile_id',
        'content',
        'is_public',
        'start_year',
        'start_month',
        'start_day',
        'end_year',
        'end_month',
        'end_day',
    ];

    protected $casts = [
        'is_public' => 'boolean',
    ];

    public function userProfile()
    {
        return $this->belongsTo(UserProfile::class);
    }

    /**
     * @return null|string
     */
    public function getDateRangeAttribute()
    {
        $startAt = '';
        if ($this->start_year) {
            $startAt .= $this->start_year;
            if ($this->start_month) {
                $startAt .= '-' . str_pad($this->start_month, 2, '0', STR_PAD_LEFT);
                if ($this->start_day) {
                    $startAt .= '-' . str_pad($this->start_day, 2, '0', STR_PAD_LEFT);
                }
            }
        }
        $endAt = '';
        if ($this->end_year) {
            $endAt .= $this->end_year;
            if ($this->end_month) {
                $endAt .= '-' . str_pad($this->end_month, 2, '0', STR_PAD_LEFT);
                if ($this->end_day) {
                    $endAt .= '-' . str_pad($this->end_day, 2, '0', STR_PAD_LEFT);
                }
            }
        }
        if ($startAt || $endAt) {
            return '（' . $startAt . ' ~ ' . $endAt . '）';
        }

        return null;
    }
}
