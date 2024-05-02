<?php

namespace App\DataTables;

use App\Models\TrBerkas;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BerkasDataTable extends DataTable
{
    private $pengajuan_id, $role;

    public function __construct($pengajuan_id, $role)
    {
        $this->pengajuan_id = $pengajuan_id;
        $this->role = $role;
    }
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
                $label = htmlentities($item->berkas_file, ENT_QUOTES, 'UTF-8');
                return '<a class="btn btn-info my-auto p-2 rounded-1" href="/uploads/'.($item->berkas_file).'" target="blank"><i class="fas fa-eye text-white m-0"></i></a>';
            })
            ->editColumn('status', function ($item) {
                $label = htmlentities($item->berkas_file, ENT_QUOTES, 'UTF-8');
                if($this->role == 'Super Admin' && $item->berkas_status == 'Belum Divalidasi' ) {
                    return '<button onclick="statusModal('.$item->berkas_id.',\''.$label.'\'\'berkas\')" class="badge bg-danger border-0">'.$item->berkas_status.'</button>';
                } else if($this->role == 'Super Admin') {
                    return '<button onclick="statusModal('.$item->berkas_id.',\''.$label.'\'\'berkas\')" class="badge bg-success border-0">'.$item->berkas_status.'</button>';
                }
                if($item->berkas_status == 'Belum Divalidasi') {
                    return '<span class="badge bg-danger border-0">'.$item->berkas_status.'</span>';
                }
                return '<span class="badge bg-success border-0">'.$item->berkas_status.'</span>';
            })
            ->orderColumn('status', 'berkas_status $1')
            ->rawColumns(['action', 'status']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(TrBerkas $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('berkas-table')
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
            Column::make('status')
                  ->orderable(true)
                  ->searchable(false)
                  ->addClass('text-center'),
            Column::make('berkas_catatan')
                    ->title('Catatan')
                    ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Berkas_' . date('YmdHis');
    }
}
