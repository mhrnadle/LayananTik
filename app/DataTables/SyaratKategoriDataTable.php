<?php

namespace App\DataTables;

use App\Models\SyaratKategori;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SyaratKategoriDataTable extends DataTable
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
            $label = htmlentities($item->syarat_label, ENT_QUOTES, 'UTF-8');
            return '<a class="btn btn-info my-auto p-2 rounded-1" href="'.route('syarat.show',$item->syarat_id).'"><i class="fas fa-power-off text-white m-0"></i></a>
                    <a class="btn btn-primary my-auto p-2 rounded-1" href="'.route('syarat.edit',$item->syarat_id).'"><i class="fas fa-user-edit text-white m-0"></i></a>
                    <button class="btn btn-danger my-auto p-2 rounded-1" onclick="deleteModal('.$item->syarat_id.',\''.$label.'\')"><i class="fas fa-trash-alt text-white m-0"></i></button>';
        })
        ->editColumn('syarat_status', function ($item) {
            return $item->syarat_status == 1 ? '<span class="badge bg-success">Aktif</span>' : '<span class="badge bg-danger">Non Aktif</span>';
        })
        ->editColumn('syarat_template', function ($item) {
            return '<a href="/templates/'.$item->syarat_template.'" target="blank">'.$item->syarat_template.'</a>';
        })
        ->orderColumn('syarat_status', 'syarat_status $1')
        ->orderColumn('syarat_template', 'syarat_template $1')
        ->rawColumns(['action', 'syarat_status', 'syarat_template']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(SyaratKategori $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('syaratkategori-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orders([[0, 'asc']])
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
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('syarat_label')
                ->addClass('text-center')
                ->title('Syarat Label'),
            Column::make('syarat_type')
                ->addClass('text-center')
                ->title('Tipe Syarat'),
            Column::make('syarat_type_file')
                ->addClass('text-center')
                ->title('Tipe File Syarat'),
            Column::computed('syarat_status')
                ->addClass('text-center')
                ->title('Status Syarat'),
            Column::computed('syarat_template')
                ->addClass('text-center')
                ->title('Template Syarat'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'SyaratKategori_' . date('YmdHis');
    }
}
