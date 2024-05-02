<?php

namespace App\DataTables;

use App\Models\KategoriLayanan;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class KategoriLayananDataTable extends DataTable
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
            $label = htmlentities($item->kl_label, ENT_QUOTES, 'UTF-8');
            $type = htmlentities("layanan", ENT_QUOTES, 'UTF-8');
            return '<a class="btn btn-info my-auto p-2 rounded-1" href="'.route('layanan.show',$item).'"><i class="fas fa-power-off text-white m-0"></i></a>
                    <a class="btn btn-primary my-auto p-2 rounded-1" href="'.route('layanan.edit',$item).'"><i class="fas fa-user-edit text-white m-0"></i></a>
                    <button class="btn btn-danger my-auto p-2 rounded-1" onclick="deleteModal('.$item->kl_id.',\''.$label.'\',\''.$type.'\')"><i class="fas fa-trash-alt text-white m-0"></i></button>';
        })
        ->editColumn('status', function ($item) {
            return $item->kl_status == 1 ? '<span class="badge bg-success">Aktif</span>' : '<span class="badge bg-danger">Non Aktif</span>';
        })
        ->orderColumn('status', 'kl_status $1')
        ->rawColumns(['action', 'status']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(KategoriLayanan $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('kategorilayanan-table')
                    ->addTableClass('table table-bordered table-hover')
                    ->columns($this->getColumns())
                    ->minifiedAjax(route('layanan.table'))
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
                ->addClass('text-center')
                ->orderable(false),
            Column::make('kunker')
                ->title('Kode Kunker')
                ->addClass('text-center'),
            Column::make('kl_label')
                ->title('Kategori Layanan'),
            Column::computed('status')
                ->orderable(true)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'KategoriLayanan_' . date('YmdHis');
    }
}
