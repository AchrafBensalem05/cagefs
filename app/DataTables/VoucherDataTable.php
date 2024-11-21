<?php

namespace App\DataTables;

use App\Models\Voucher;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
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
                    return "<button data-target='#healthcare-entity-billing-change' data-toggle='modal' data-url='" . route('healthcareEntity.set_healthcare_billing_status' , $record->id) . "'   class='btn bg-warning'>". __('pending') ."</span>";
                elseif($record->status == 'checked')
                    return "<button data-target='#healthcare-entity-billing-change' data-toggle='modal' data-url='" . route('healthcareEntity.set_healthcare_billing_status' , $record->id) . "'   class='btn bg-success'><i class='fa fa-check'></i>" . __('checked') ."</span>";
                else
                    return "<button data-target='#healthcare-entity-billing-change' data-toggle='modal' data-url='" . route('healthcareEntity.set_healthcare_billing_status' , $record->id) . "'   class='btn bg-danger'>". __('refused') ."</span>";

            })
            ->editColumn('healthcare' , function ($record)
            {
                if($record->healthcare)
                    return "<span  class='badge bg-dark'>". optional($record->healthcare)->name ."</span>";
            })
            ->editColumn('id'  , function ($record){
                return '#';
            })
            ->editColumn('created_at' , fn($record) => $record->created_at->format('Y-M-d'))
            ->editColumn('file'  , function ($record){
                return "<a download href='" . $record->getFirstMediaUrl('file') . "' class='btn btn-primary text-white'> <i class='fa fa-download'></i> " . __('View') ."</a>";
            })
            ->rawColumns(['status' , 'file' , 'healthcare' ])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Voucher $model): QueryBuilder
    {
        return $model->newQuery();
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
            Column::make('healthcare')->searchable(false),
            Column::make('status'),
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
