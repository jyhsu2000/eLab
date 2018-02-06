<?php

namespace App\DataTables;

use App\User;
use App\UserProfile;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
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
            ->addColumn('action', 'user.datatables.action')
            ->editColumn('name', 'user.datatables.name')
            ->editColumn('email', 'user.datatables.email')
            ->editColumn('user_profile', 'user.datatables.user_profile')
            ->filterColumn('user_profile', function ($query, $keyword) {
                /** @var Builder|User $query */
                $query->whereHas('userProfile', function ($query) use ($keyword) {
                    /** @var Builder|UserProfile $query */
                    $query->where('name', 'like', "%{$keyword}%")
                        ->orWhere('nickname', 'like', "%{$keyword}%");
                });
            })
            ->escapeColumns([]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery()->with('roles', 'userProfile');
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
            ->addAction(['title' => '操作'])
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
            'id'           => ['title' => '#'],
            'name'         => ['title' => '使用者'],
            'email'        => ['title' => '信箱'],
            'user_profile' => [
                'title'     => '成員',
                'orderable' => false,
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
        return 'user_' . time();
    }
}
