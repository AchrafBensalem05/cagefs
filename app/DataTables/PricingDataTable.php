<?php

namespace App\DataTables;

use App\Models\Pricing;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PricingDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('actions', fn($record) => "  ".
                (Auth::user()->can('user-edit') ?
                    "<a href='".route("pricings.edit" , $record->id)."' class='btn btn-info btn-sm mr-1'><i class='fas fa-pencil-alt'></i>Edit</a>" : "").
                (Auth::user()->can('user-delete') ?
                    "<a href='".route("pricings.show" , $record->id)."' class='btn btn-sm btn-danger'><i class='fas fa-trash'></i>Delete</a>" : "") .
                " ")
            ->editColumn('created_at' , fn($record) => $record->created_at->format('Y-M-d'))
            ->rawColumns(["actions"])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Pricing $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('pricing-table')
                    ->columns($this->getColumns())
                    ->ajax([
                        "url"  => route("pricings.get_index")
                    ])->orderBy(1);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->title("#ID")->searchable(true)->orderable(true),
            Column::make('title')->title(__('Title'))->searchable(true)->orderable(true),
            Column::make('created_at')->title(__('created_at'))->searchable(true)->orderable(true),
            'actions',
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Pricing_' . date('YmdHis');
    }
}
