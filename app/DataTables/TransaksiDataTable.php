<?php

namespace App\DataTables;

use App\Models\Transaksi;
use App\Models\TrPengajuan;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TransaksiDataTable extends DataTable
{
    private $role;
    public function __construct($role)
    {
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
                $label = htmlentities($item->pengajuan_detail, ENT_QUOTES, 'UTF-8');
                if($this->role == 'Super Admin') {
                    return '<a class="btn btn-primary my-auto p-2 rounded-1" href="'.route('transaksi.edit',$item->pengajuan_id).'"><i class="fas fa-user-edit text-white m-0"></i></a>
                            <button class="btn btn-danger my-auto p-2 rounded-1" onclick="deleteModal('.$item->pengajuan_id.',\''.$label.'\')"><i class="fas fa-trash-alt text-white m-0"></i></button>';
                }
                if($item->pengajuan_status == 'Ditolak') {
                    return '<a class="btn btn-primary my-auto p-2 rounded-1" href="'.route('transaksi.edit',$item->pengajuan_id).'"><i class="fas fa-user-edit text-white m-0"></i></a>
                            <button class="btn btn-danger my-auto p-2 rounded-1" onclick="deleteModal('.$item->pengajuan_id.',\''.$label.'\')"><i class="fas fa-trash-alt text-white m-0"></i></button>';
                }
                
            })
            ->editColumn('pengajuan_status', function ($item) {
                $label = htmlentities($item->pengajuan_detail, ENT_QUOTES, 'UTF-8');
                if($item->pengajuan_status == 'Ditolak' && $this->role == 'Super Admin') {
                    return '<button onclick="statusModal('.$item->pengajuan_id.',\''.$label.'\')" class="badge bg-danger border-0">'.$item->pengajuan_status.'</button>';
                } else if($this->role == 'Super Admin') {
                    return '<button onclick="statusModal('.$item->pengajuan_id.',\''.$label.'\')" class="badge bg-success border-0">'.$item->pengajuan_status.'</button>';
                }
                if($item->pengajuan_status == 'Ditolak') {
                    return '<span class="badge bg-danger border-0">'.$item->pengajuan_status.'</span>';
                }
                return '<span class="badge bg-success border-0">'.$item->pengajuan_status.'</span>';
            })
            ->orderColumn('pengajuan_status', 'pengajuan_status $1')
            ->rawColumns(['action', 'pengajuan_status']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(TrPengajuan $model): QueryBuilder
    {
        if($this->role == 'Super Admin') {
            return $model->newQuery();
        }
        return $model->newQuery()
        ->where('users_id', auth()->user()->id);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('transaksi-table')
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
                ->addClass('text-center align-middle'),
            Column::make('pengajuan_detail')
                ->addClass('text-center align-middle')
                ->title('Detail Pengajuan'),
            Column::make('pengajuan_status')
                ->addClass('text-center align-middle')
                ->title('Status Pengajuan'),
            Column::make('pengajuan_catatan')
                ->addClass('text-center align-middle')
                ->title('Catatan Pengajuan'),
            Column::computed('action')
                    ->exportable(false)
                    ->printable(false)
                    ->width(60)
                    ->addClass('text-center align-middle'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Transaksi_' . date('YmdHis');
    }
}
