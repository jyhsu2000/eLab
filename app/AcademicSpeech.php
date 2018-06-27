<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\AcademicSpeech
 *
 * @property int $id
 * @property string $title 演講題目
 * @property string|null $location 地點
 * @property string|null $date 日期
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AcademicSpeech whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AcademicSpeech whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AcademicSpeech whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AcademicSpeech whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AcademicSpeech whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AcademicSpeech whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AcademicSpeech extends Model
{
    protected $fillable = [
        'title',
        'location',
        'date',
    ];
}
