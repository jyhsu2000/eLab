<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ContactInfo
 *
 * @property int $id
 * @property int $user_profile_id 個人資料
 * @property int $contact_type_id 聯絡資料類型
 * @property string $content 內容
 * @property bool $is_public 公開顯示
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\ContactType $contactType
 * @property-read \App\UserProfile $userProfile
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContactInfo whereContactTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContactInfo whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContactInfo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContactInfo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContactInfo whereIsPublic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContactInfo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContactInfo whereUserProfileId($value)
 * @mixin \Eloquent
 */
class ContactInfo extends Model
{
    protected $fillable = [
        'user_profile_id',
        'contact_type_id',
        'content',
        'is_public',
    ];

    protected $casts = [
        'is_public' => 'boolean',
    ];

    public function contactType()
    {
        return $this->belongsTo(ContactType::class);
    }

    public function userProfile()
    {
        return $this->belongsTo(UserProfile::class);
    }
}
