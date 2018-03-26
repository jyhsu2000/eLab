<?php

namespace App\DataTables;

use App\ContactInfo;
use App\User;
use App\UserProfile;
use Illuminate\Database\Eloquent\Builder;
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
            ->editColumn('year', function ($userProfile) {
                /** @var UserProfile $userProfile */
                return view('user-profile.datatables.year', compact('userProfile'))->render();
            })
            ->orderColumn('year', 'in_year $1')
            ->editColumn('name', function ($userProfile) {
                /** @var UserProfile $userProfile */
                return view('user-profile.datatables.name', compact('userProfile'))->render();
            })
            ->editColumn('contact', function ($userProfile) {
                /** @var UserProfile $userProfile */
                return view('user-profile.datatables.contact', compact('userProfile'))->render();
            })
            ->filterColumn('contact', function ($query, $keyword) {
                /** @var Builder|UserProfile $query */
                $query->whereHas('contactInfos', function ($query) use ($keyword) {
                    /** @var Builder|ContactInfo $query */
                    /** @var User $user */
                    $user = auth()->user();
                    if (!\Laratrust::can('user-profile.manage') && !optional($user)->userProfile) {
                        $query->where(function ($query) {
                            /** @var Builder|ContactInfo $query */
                            $query->where('is_public', true);
                        });
                    }

                    $query->where('content', 'like', "%$keyword%");
                });
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
        return $model->newQuery()->with('user', 'contactInfos.contactType');
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
            'year'          => [
                'title'      => '學年度',
//                'orderable'  => false,
                'searchable' => false,
            ],
            'in_year'       => [
                'title'   => '入學年度',
                'visible' => false,
            ],
            'graduate_year' => [
                'title'   => '畢業年度',
                'visible' => false,
            ],
            'type'          => ['title' => '身分'],
            'name'          => ['title' => '姓名'],
            'nickname'      => [
                'title'   => '暱稱',
                'visible' => false,
            ],
            'contact'       => [
                'title'     => '聯絡資訊',
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
        return 'user_profile_' . time();
    }
}
