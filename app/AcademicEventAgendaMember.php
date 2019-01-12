<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\AcademicEventAgendaMember
 *
 * @property int $id
 * @property string $agenda_name 會議名稱
 * @property string|null $date 會議時間
 * @property string|null $location 會議地點
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AcademicEventAgendaMember newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AcademicEventAgendaMember newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AcademicEventAgendaMember query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AcademicEventAgendaMember whereAgendaName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AcademicEventAgendaMember whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AcademicEventAgendaMember whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AcademicEventAgendaMember whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AcademicEventAgendaMember whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AcademicEventAgendaMember whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AcademicEventAgendaMember extends Model
{
    protected $fillable = [
        'agenda_name',
        'date',
        'location',
    ];
}
