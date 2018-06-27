<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\AcademicHonor
 *
 * @property int $id
 * @property string $award_record 獲獎紀錄
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
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
