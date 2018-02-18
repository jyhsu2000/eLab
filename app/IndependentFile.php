<?php

namespace App;

use Bnb\Laravel\Attachments\HasAttachment;
use Illuminate\Database\Eloquent\Model;

/**
 * App\IndependentFile
 *
 * @property int $id
 * @property string $name 名稱
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Bnb\Laravel\Attachments\Attachment[] $attachments
 * @method static \Illuminate\Database\Eloquent\Builder|\App\IndependentFile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\IndependentFile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\IndependentFile whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\IndependentFile whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class IndependentFile extends Model
{
    use HasAttachment;

    protected $fillable = [
        'name',
    ];
}
