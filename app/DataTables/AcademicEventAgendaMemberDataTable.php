<?php

namespace App\DataTables;

use App\AcademicEventAgendaMember;
use Laratrust;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class AcademicEventAgendaMemberDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        if (Laratrust::can('setting.manage')) {
            $dataTable->addColumn('action', 'academic-event-agenda-member.datatables.action');
        }

        return $dataTable
            ->escapeColumns([]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param AcademicEventAgendaMember $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(AcademicEventAgendaMember $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        $html = $this->builder()
            ->columns($this->getColumns())
            ->ajax('')
            ->parameters($this->getBuilderParameters())
            ->parameters([
                'order'      => [[0, 'asc']],
                'pageLength' => 50,
            ]);

        if (Laratrust::can('setting.manage')) {
            $html->addAction(['title' => '操作']);
        }

        return $html;
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id'          => ['title' => '#'],
            'agenda_name' => ['title' => '會議名稱'],
            'date'        => ['title' => '會議時間'],
            'location'    => ['title' => '會議地點'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'academic_event_agenda_member_' . time();
    }
}
