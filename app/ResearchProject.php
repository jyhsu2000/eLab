<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ResearchProject
 *
 * @property int $id
 * @property string $name 計畫名稱
 * @property string|null $job 擔任工作
 * @property string|null $date_range 起迄年月
 * @property string|null $subsidy_agency 補助機構
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ResearchProject newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ResearchProject newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ResearchProject query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ResearchProject whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ResearchProject whereDateRange($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ResearchProject whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ResearchProject whereJob($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ResearchProject whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ResearchProject whereSubsidyAgency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ResearchProject whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ResearchProject extends Model
{
    protected $fillable = [
        'name',
        'job',
        'date_range',
        'subsidy_agency',
    ];
}
