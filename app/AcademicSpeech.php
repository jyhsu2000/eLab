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
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AcademicSpeech newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AcademicSpeech newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AcademicSpeech query()
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
