<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\AcademicEventCommitteeMember
 *
 * @property int $id
 * @property string $committee_name 名稱
 * @property string|null $date_range 起迄年月
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AcademicEventCommitteeMember newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AcademicEventCommitteeMember newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AcademicEventCommitteeMember query()
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
