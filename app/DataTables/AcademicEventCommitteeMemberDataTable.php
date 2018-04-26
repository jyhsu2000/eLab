<?php

namespace App\DataTables;

use App\AcademicEventCommitteeMember;
use Laratrust;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class AcademicEventCommitteeMemberDataTable extends DataTable
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
            $dataTable->addColumn('action', 'academic-event-committee-member.datatables.action');
        }

        return $dataTable
            ->escapeColumns([]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param AcademicEventCommitteeMember $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(AcademicEventCommitteeMember $model)
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
            'id'             => ['title' => '#'],
            'committee_name' => ['title' => '名稱'],
            'date_range'     => ['title' => '起訖年月'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'academic_event_committee_member_' . time();
    }
}
