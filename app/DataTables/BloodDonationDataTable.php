<?php

namespace App\DataTables;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BloodDonationDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('created_at' , fn($record) => $record->created_at->format('Y-M-d'))
            ->editColumn('blood' , fn($record) => "<span class='badge badge-danger'>$record->blood</span>")
            ->addColumn('wilaya' , fn($record) => $record->daira->wilaya->name)
            ->rawColumns([ 'blood'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Patient $model): QueryBuilder
    {
        return $model->newQuery()->where('donor' , 'yes');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('blood-donors-table')
                    ->columns($this->getColumns())
                    ->ajax([
                        "url"  => route("blood.donors.get_index")
                    ])->orderBy(1);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->title("#ID")->searchable(true)->orderable(true),
            Column::make('name')->title(__('Name'))->searchable(true)->orderable(true),
            Column::make('email')->title(__('email'))->searchable(true)->orderable(true),
            Column::make('phone')->title(__('phone number'))->searchable(true)->orderable(true),
            Column::make('blood')->title(__('blood group'))->searchable(true)->orderable(true),
            'wilaya',
            Column::make('birth_date')->title(__('Date of Birth'))->searchable(true)->orderable(true),
            Column::make('created_at')->title(__('created_at'))->searchable(true)->orderable(true),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Patient_' . date('YmdHis');
    }
}
