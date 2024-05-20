<?php

namespace App\DataTables;

use App\Models\KategoriAset;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class kategoriDataTable extends DataTable
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
                $label = htmlentities($item->layanan_nama, ENT_QUOTES, 'UTF-8');
                return '<a class="btn btn-info my-auto p-2 rounded-1" href="'.route('info-layanan.show',$item).'"><i class="fas fa-power-off text-white m-0"></i></a>
                        <a class="btn btn-primary my-auto p-2 rounded-1" href="'.route('info-layanan.edit',$item).'"><i class="fas fa-user-edit text-white m-0"></i></a>
                        <button class="btn btn-danger my-auto p-2 rounded-1" onclick="deleteModal('.$item->layanan_id.',\''.$label.'\')"><i class="fas fa-trash-alt text-white m-0"></i></button>';
            })
            ->editColumn('kategori', function ($item) {
                return $item->kategori == 1 ? '<span class="badge bg-success">Aktif</span>' : '<span class="badge bg-danger">Non Aktif</span>';
            })
            ->orderColumn('kategori', 'kategori $1')
            ->rawColumns(['kategori', 'kategori']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Kategori $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('lokasi-table')
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
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            Column::make('NamaKategori')
                ->title('Nama Kategori')
                ->addClass('text-center'),
            Column::make('IdKategori')
                ->title('ID Kategori'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'kategori' . date('YmdHis');
    }
}
