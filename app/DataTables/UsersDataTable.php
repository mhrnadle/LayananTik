<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addIndexColumn('DT_RowIndex')
        ->editColumn('action', function ($item) {
            $username = htmlentities($item->username, ENT_QUOTES, 'UTF-8');
            return '<a class="btn btn-info my-auto p-2 rounded-1" href="'.route('users.show',$item->id).'" data-bs-toggle="tooltip" data-bs-original-title="View User"><i class="fas fa-eye text-white m-0"></i></a>
                    <a class="btn btn-primary my-auto p-2 rounded-1" href="'.route('users.edit',$item->id).'" data-bs-toggle="tooltip" data-bs-original-title="Edit User"><i class="fas fa-user-edit text-white m-0"></i></a>
                    <button class="btn btn-danger my-auto p-2 rounded-1" onclick="deleteModal('.$item->id.',\''.$username.'\')"><i class="fas fa-trash-alt text-white m-0"></i></button>';
        })
        ->editColumn('role', function ($item) {
            return implode(', ', $item->roles->pluck('name')->toArray());
        });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('users-table')
                    ->addTableClass('table align-items-center mb-0')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orders([[0, 'asc']])
                    ->lengthMenu([5, 10, 25, 50, 100])
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')
                    ->title('No')
                    ->searchable(false)
                    ->orderable(false)
                    ->width(60)
                    ->addClass('text-center'),
            Column::computed('action')
            ->addClass('')
            ->exportable(false)
            ->printable(false)
            ->width(60)
            ->addClass('text-center'),
            Column::make('username'),
            Column::make('name'),
            Column::make('email'),
            Column::make('role'),
            Column::make('no_telp'),
            Column::make('alamat'),
            Column::make('type_akun'),
            Column::make('nip'),
            Column::make('id_peg'),
            Column::make('kunker'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Users_' . date('YmdHis');
    }
}
