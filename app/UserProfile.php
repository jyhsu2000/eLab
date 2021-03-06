<?php

namespace App;

use Bnb\Laravel\Attachments\HasAttachment;
use Illuminate\Database\Eloquent\Model;

/**
 * App\UserProfile
 *
 * @property int $id
 * @property int|null $user_id 使用者
 * @property bool $is_member 是否為實驗室成員
 * @property int|null $in_year 入學年度
 * @property int|null $graduate_year 畢業年度
 * @property bool $in_school 在學中
 * @property string|null $type 身分
 * @property string|null $name 姓名
 * @property string|null $nickname 暱稱
 * @property string|null $info 個人簡介
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Bnb\Laravel\Attachments\Attachment[] $attachments
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ContactInfo[] $contactInfos
 * @property-read bool $has_permission
 * @property-read null|string $photo_url
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\JobExperience[] $jobExperiences
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserProfile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserProfile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserProfile query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserProfile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserProfile whereGraduateYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserProfile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserProfile whereInSchool($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserProfile whereInYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserProfile whereInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserProfile whereIsMember($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserProfile whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserProfile whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserProfile whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserProfile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserProfile whereUserId($value)
 * @mixin \Eloquent
 */
class UserProfile extends Model
{
    use HasAttachment;

    protected $fillable = [
        'user_id',
        'is_member',
        'in_year',
        'graduate_year',
        'in_school',
        'type',
        'name',
        'nickname',
        'email',
        'office_phone',
        'home_phone',
        'cell_phone',
        'link',
        'info',
    ];

    protected $appends = [
        'photoUrl',
    ];

    protected $casts = [
        'is_member' => 'boolean',
        'in_school' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contactInfos()
    {
        return $this->hasMany(ContactInfo::class)->orderBy('contact_type_id');
    }

    public function jobExperiences()
    {
        return $this->hasMany(JobExperience::class);
    }

    /**
     * @return null|string
     */
    public function getPhotoUrlAttribute()
    {
        //自動緩存
        $cacheKey = 'user_profile_' . $this->id . '_photo_' . $this->updated_at->timestamp;
        $photoUrl = \Cache::rememberForever($cacheKey, function () {
            $attachment = $this->attachment('photo');
            if (!$attachment) {
                //cache不支援null，存false代替
                return false;
            }

            return $attachment->url . '?disposition=inline';
        });

        return $photoUrl;
    }

    /**
     * 檢查當前使用者有無其編輯權限
     *
     * @return bool
     */
    public function getHasPermissionAttribute()
    {
        return \Laratrust::owns($this) || \Laratrust::can('user-profile.manage');
    }
}
