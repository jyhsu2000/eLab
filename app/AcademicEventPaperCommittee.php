<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\AcademicEventPaperCommittee
 *
 * @property int $id
 * @property string $journal_name 期刊名稱
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AcademicEventPaperCommittee whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AcademicEventPaperCommittee whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AcademicEventPaperCommittee whereJournalName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AcademicEventPaperCommittee whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AcademicEventPaperCommittee extends Model
{
    protected $fillable = [
        'journal_name',
    ];
}
