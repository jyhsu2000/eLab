<?php

namespace App\DataTables;

use App\UserProfile;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class UserProfileDataTable extends DataTable
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

        return $dataTable
            ->editColumn('name', function ($userProfile) {
                /** @var UserProfile $userProfile */
                return view('user-profile.datatables.name', compact('userProfile'))->render();
            })
            ->escapeColumns([]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param UserProfile $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(UserProfile $model)
    {
        return $model->newQuery()->with('user');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->ajax('')
            ->parameters($this->getBuilderParameters())
            ->parameters([
                'order'      => [[0, 'asc']],
                'pageLength' => 50,
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id'            => ['title' => '#'],
            'in_year'       => ['title' => '入學年度'],
            'graduate_year' => ['title' => '畢業年度'],
            'type'          => ['title' => '類型'],
            'name'          => ['title' => '姓名'],
            'nickname'      => [
                'title'   => '暱稱',
                'visible' => false,
            ],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'user_profile_' . time();
    }
}
