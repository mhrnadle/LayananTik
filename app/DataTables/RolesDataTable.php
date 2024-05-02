<?php

namespace App\DataTables;

use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RolesDataTable extends DataTable
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
            $label = htmlentities($item->name, ENT_QUOTES, 'UTF-8');
            return '<a class="btn btn-info my-auto p-2 rounded-1" href="'.route('roles.show',$item).'"><i class="fas fa-eye text-white m-0"></i></a>
                    <a class="btn btn-primary my-auto p-2 rounded-1" href="'.route('roles.edit',$item).'"><i class="fas fa-user-edit text-white m-0"></i></a>
                    <button class="btn btn-danger my-auto p-2 rounded-1" onclick="deleteModal('.$item->id.',\''.$label.'\')"><i class="fas fa-trash-alt text-white m-0"></i></button>';
        });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Role $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('roles-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
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
                    ->orderable(false)
                    ->exportable(false)
                    ->printable(false)
                    ->width(60)
                    ->addClass('text-center'),
            Column::make('name')
                    ->title('Role Name')
                    ->addClass('text-center'),
            Column::make('guard_name')
                    ->title('Guard Name')
                    ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Roles_' . date('YmdHis');
    }
}
