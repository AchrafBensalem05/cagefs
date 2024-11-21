<?php

namespace App\DataTables\Front\Healthcare;

use App\Models\Voucher;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VoucherDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('status' , function ($record)
            {
                if ($record->status == 'pending')
                    return "<span  class='badge bg-warning'>". __('pending') ."</span>";
                elseif($record->status == 'checked')
                    return "<span  class='badge bg-success'><i class='fa fa-check'></i>" . __('checked') ."</span>";
                else
                    return "<span  class='badge bg-danger'>". __('refused') ."</span>";
            })
            ->editColumn('file'  , function ($record){
                return "<a download href='" . $record->getFirstMediaUrl('file') . "' class='btn btn-primary text-white'> <i class='fa fa-download'></i> " . __('View') ."</a>";
            })
            ->editColumn('pricing_id' , function ($record)
            {
                return "<span class='badge bg-info'>" . optional($record->pricing)->title . "</span>";
            })
            ->editColumn('created_at' , fn($record) => $record->created_at->format('Y-M-d'))
            ->rawColumns(['status' , 'file' , 'pricing_id' ])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Voucher $model): QueryBuilder
    {
        return $model->newQuery()->where('healthcare_id' , Auth::guard('healthcare')->id())->orderBy('created_at' , 'desc');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('voucher-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax();
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('title'),
            Column::make('status'),
            Column::make('pricing_id')->title('Pricing'),
            Column::computed('file')->title('Voucher'),
            Column::make('created_at'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Voucher_' . date('YmdHis');
    }
}
