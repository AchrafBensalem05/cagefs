<?php

namespace App\DataTables;

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
            ->addColumn('actions', fn($record) => "  ".
                (Auth::user()->can('appoin-edit') ?
                    "<a href='".route("appointment.edit" , [$record->type , $record->id])."' class='btn btn-info btn-sm mr-1'><i class='fas fa-pencil-alt'></i>Edit</a>" : "").
                (Auth::user()->can('appoin-delete') ?
                    "<a href='".route("appointment.show" , [$record->type , $record->id])."' class='btn btn-sm btn-danger'><i class='fas fa-trash'></i>Delete</a>" : "") .
                " ")
            ->editColumn("name" ,  fn($record) => $record->name . ($record->patient_id == null ? " <span class='badge badge-info'>Anonym</span>" : ''))
            ->editColumn('status' , function ($record)
            {
                if ($record->status == 'pending')
                    return "<span  class='badge badge-warning'>pending</span>";
                elseif($record->status == 'canceled')
                    return "<span  class='badge badge-danger'>Canceled</span>";
                else
                    return "<span  class='badge badge-success'>Done</span>";
            })
            ->editColumn('created_at' , fn($record) => $record->created_at->format('Y-M-d'))
            ->rawColumns(["actions"  , 'name' , 'status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Appointment $model): QueryBuilder
    {
        return $model->newQuery()->with(["service"])->where('type' , $this->request()->segment(3));
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
                            "url"  => route("appointments.get_index" , $this->request()->segment(3))
                        ])
                    ->orderBy(1);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->title("#ID")->searchable(true)->orderable(true),
            Column::make('name')->title(__('Name'))->searchable(true)->orderable(true),
            Column::make('phone')->title(__('Phone'))->searchable(true)->orderable(true),
            Column::make('service.title')->title(__('Service'))->searchable(true)->orderable(true),
            Column::make('status')->title(__('Status'))->searchable(true)->orderable(true),
            Column::make('created_at')->title(__('created_at'))->searchable(true)->orderable(true),
            'actions',
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
