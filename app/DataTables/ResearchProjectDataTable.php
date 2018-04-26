<?php

namespace App\DataTables;

use App\ResearchProject;
use Laratrust;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class ResearchProjectDataTable extends DataTable
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
            $dataTable->addColumn('action', 'research-project.datatables.action');
        }

        return $dataTable
            ->escapeColumns([]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param ResearchProject $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ResearchProject $model)
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
            'name'           => ['title' => '計畫名稱'],
            'job'            => ['title' => '擔任工作'],
            'date_range'     => ['title' => '起迄年月'],
            'subsidy_agency' => ['title' => '補助機構'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'research_project_' . time();
    }
}
