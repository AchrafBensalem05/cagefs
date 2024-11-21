<?php

namespace App\DataTables\Front\Healthcare;

use App\Models\Appointment;
use App\Services\Registration\RegistrationFilter;
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
            ->addColumn('actions',
                fn($record) =>
                ($record->status == 'waiting' ?  "<a class='confirm-text' href='" . route('healthcare.validate_appointment' , $record->id) ."' ><img src='" .asset('patient/assets/img/icons/check.svg') . "' alt='img'></a>" : "").
                "<a class='confirm-text' href='" . route('healthcare.delete_registration' , $record->id) ."' ><img src='" .asset('patient/assets/img/icons/delete.svg') . "' alt='img'></a>"
            )
            ->editColumn('patient_id' , fn($record) => $record->patient_id ?  "<span class='badge bg-info'>NO</span>" : "<span class='badge bg-dark'>YES</span>")
            ->editColumn('service_id' , fn($record) => optional($record->service)->title )
            ->editColumn('started_at' , fn($record) => "<span class='badge bg-secondary'>" .$record->started_at. "</span>" )
            ->editColumn('created_at' , fn($record) => $record->created_at->format('Y-M-d'))
            ->editColumn('status' , function ($record)
            {
                if ($record->status == 'pending')
                    return "<span  class='badge bg-warning'>". __('pending') ."</span>";
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
            ->rawColumns(['patient_id','status' , 'actions' ,'started_at'])
            ->setRowId('id');


    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Appointment $model): QueryBuilder
    {
        return RegistrationFilter::filters(["started_at"] , Auth::guard('healthcare')->user()->appointments()->getQuery() , request())->orderBy('created_at' , 'desc');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('my-appointments-table')
                    ->columns($this->getColumns())
                    ->ajax(
                        [
                            "url"  => route("healthcare.get_my_appointments_data"),
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
            Column::make('name')->title(__('Patient Name'))->searchable(true)->orderable(true),
            Column::make('service_id')->title(__('Service'))->searchable(true)->orderable(true),
            Column::make('status')->title(__('status'))->searchable(true)->orderable(true),
            Column::make('phone')->title(__('Phone number'))->searchable(true)->orderable(true),
            Column::make('started_at')->title(__('Registration date'))->searchable(true)->orderable(true),
            Column::make('created_at')->title(__('created_at'))->searchable(true)->orderable(true),
            Column::make('patient_id')->title(__('Anonyme'))->searchable(true)->orderable(true),
            'actions',
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Registration_' . date('YmdHis');
    }
}
