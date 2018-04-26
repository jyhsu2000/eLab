<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\AcademicEventCommitteeMember
 *
 * @property int $id
 * @property string $committee_name 名稱
 * @property string|null $date_range 起迄年月
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AcademicEventCommitteeMember whereCommitteeName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AcademicEventCommitteeMember whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AcademicEventCommitteeMember whereDateRange($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AcademicEventCommitteeMember whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AcademicEventCommitteeMember whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AcademicEventCommitteeMember extends Model
{
    protected $fillable = [
        'committee_name',
        'date_range',
    ];
}
