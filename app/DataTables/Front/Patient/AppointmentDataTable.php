<?php

namespace App\DataTables\Front\Patient;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AppointmentDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('service_id' , fn($record) => optional($record->service)->title )
            ->editColumn('healthcare_entity_id' , fn($record) => "<a class='text-primary' target='_blank' href='" . route('front.get_healthcare_entity_page' , $record->healthcareEntity->slug) . "'>" . optional($record->healthcareEntity)->name ."</a>")
            ->editColumn('started_at' , fn($record) => "<span class='badge bg-secondary'>" .$record->started_at. "</span>" )
            ->editColumn('created_at' , fn($record) => $record->created_at->format('Y-M-d'))
            ->editColumn('status' , function ($record)
            {
                if ($record->status == 'pending')
                    return "<span  class='badge bg-warning'>pending</span>";
                elseif($record->status == 'canceled')
                    return "<span  class='badge bg-danger'>Canceled</span>";
                elseif($record->status == 'waiting')
                    return "<span  class='badge bg-dark'>Waiting for approval</span>";
                else
                    return "<span  class='badge bg-success'>Done</span>";
            })
            ->editColumn('id'  , function ($record){
                return '#';
            })
            ->rawColumns(['status' , 'actions' ,'started_at' , 'healthcare_entity_id'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Appointment $model): QueryBuilder
    {
        return $model->newQuery()->where('patient_id' , Auth::guard('patient')->id())->orderBy('created_at' , 'desc');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('appointment-table')
                    ->columns($this->getColumns())
                    ->ajax(
                        [
                            "url"  => route("patient.get_my_appointments_data"),
                            'data' => 'function(d) {d.started_at = $(".filter[name=started_at]").val();}'
                        ])
                    ->orderBy(1);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->title("#")->searchable(true)->orderable(true),
            Column::make('name')->title(__('name'))->searchable(true)->orderable(true),
            Column::make('healthcare_entity_id')->title(__('Healthcare Provider'))->searchable(true)->orderable(true),
            Column::make('service_id')->title(__('Service'))->searchable(true)->orderable(true),
            Column::make('status')->title(__('status'))->searchable(true)->orderable(true),
            Column::make('started_at')->title(__('Registration Date'))->searchable(true)->orderable(true),
            Column::make('created_at')->title(__('created_at'))->searchable(true)->orderable(true),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Appointment_' . date('YmdHis');
    }
}
