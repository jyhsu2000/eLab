<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\AcademicEventJournalEditor
 *
 * @property int $id
 * @property string $journal_name 期刊名稱
 * @property string|null $date 時間
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AcademicEventJournalEditor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AcademicEventJournalEditor whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AcademicEventJournalEditor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AcademicEventJournalEditor whereJournalName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AcademicEventJournalEditor whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AcademicEventJournalEditor extends Model
{
    protected $fillable = [
        'journal_name',
        'date',
    ];
}
