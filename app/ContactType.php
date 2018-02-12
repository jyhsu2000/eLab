<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ContactType
 *
 * @property int $id
 * @property string $name 名稱
 * @property string $icon_class 圖標class
 * @property bool $is_url 是否為網址欄位
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ContactInfo[] $contactInfos
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContactType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContactType whereIconClass($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContactType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContactType whereIsUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContactType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContactType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ContactType extends Model
{
    protected $fillable = [
        'name',
        'icon_class',
        'is_url',
    ];

    protected $casts = [
        'is_url' => 'boolean',
    ];

    public function contactInfos()
    {
        return $this->hasMany(ContactInfo::class);
    }
}
