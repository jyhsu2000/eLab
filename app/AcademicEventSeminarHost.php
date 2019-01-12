<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\AcademicEventSeminarHost
 *
 * @property int $id
 * @property string $agenda_name 會議名稱
 * @property string|null $date 會議時間
 * @property string|null $location 會議地點
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AcademicEventSeminarHost newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AcademicEventSeminarHost newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AcademicEventSeminarHost query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AcademicEventSeminarHost whereAgendaName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AcademicEventSeminarHost whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AcademicEventSeminarHost whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AcademicEventSeminarHost whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AcademicEventSeminarHost whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AcademicEventSeminarHost whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AcademicEventSeminarHost extends Model
{
    protected $fillable = [
        'agenda_name',
        'date',
        'location',
    ];
}
