<?php

namespace App;

use Bnb\Laravel\Attachments\HasAttachment;
use Illuminate\Database\Eloquent\Model;

/**
 * App\UserProfile
 *
 * @property int $id
 * @property int|null $user_id 使用者
 * @property int|null $in_year 入學年度
 * @property int|null $graduate_year 畢業年度
 * @property bool $in_school 在學中
 * @property string|null $type 類型
 * @property string|null $name 姓名
 * @property string|null $nickname 暱稱
 * @property string|null $info 個人簡介
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Bnb\Laravel\Attachments\Attachment[] $attachments
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ContactInfo[] $contactInfos
 * @property-read null|string $photo_url
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserProfile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserProfile whereGraduateYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserProfile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserProfile whereInSchool($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserProfile whereInYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserProfile whereInfo($value)
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

    public static function getTypeOptions()
    {
        $types = ['教授', '碩士班', '博士班', '碩專班', '其他'];
        $options = [null => ' - 請下拉選擇 - '] + array_combine($types, $types);

        return $options;
    }

    /**
     * @return null|string
     */
    public function getPhotoUrlAttribute()
    {
        //自動緩存一天
        $cacheKey = 'user_profile_' . $this->id . '_photo_' . $this->updated_at->timestamp;
        $photoUrl = \Cache::remember($cacheKey, 1440, function () {
            $attachment = $this->attachment('photo');
            if (!$attachment) {
                //cache不支援null，存false代替
                return false;
            }

            return $attachment->url . '?disposition=inline';
        });

        return $photoUrl;
    }
}
