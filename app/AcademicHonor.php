<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\AcademicHonor
 *
 * @property int $id
 * @property string $award_record 獲獎紀錄
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AcademicHonor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AcademicHonor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AcademicHonor query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AcademicHonor whereAwardRecord($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AcademicHonor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AcademicHonor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AcademicHonor whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AcademicHonor extends Model
{
    protected $fillable = [
        'award_record',
    ];
}
