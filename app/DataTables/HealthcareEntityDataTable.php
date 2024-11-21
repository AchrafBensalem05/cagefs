<?php

namespace App\DataTables;

use App\Models\HealthcareEntity;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class HealthcareEntityDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('actions', fn($record) => "
             <a href='" . route('front.get_healthcare_poster_page', $record->slug) . "' target='_blank' class='btn btn-sm btn-warning'><i class='fa fa-image'></i></a>
             ".
                (Auth::user()->can('healthcare-entity-edit') ?
                    "<a href='".route("healthcareEntity.edit" , [$record->type , $record->id])."' class='btn btn-info btn-sm mr-1'><i class='fas fa-pencil-alt'></i>Modifier</a>" : "").
                (Auth::user()->can('healthcare-entity-delete') ?
                    "<a href='".route("healthcareEntity.show" , [$record->type , $record->id])."' class='btn btn-sm btn-danger'><i class='fas fa-trash'></i> Supprimer</a>" : "") .
                " ")
            ->addColumn('is open' , function ($record)
            {
                switch ($record->is_open_now)
                {
                    case "open":
                        $bgclass = 'bg-success';
                        break;
                    case "closed":
                        $bgclass = 'bg-danger';
                        break;
                    case "uknown":
                        $bgclass = 'bg-warning';
                        break;
                    default:
                        $bgclass = 'bg-info';
                        break;
                }
                return "<span class='badge " . $bgclass ."'>". $record->is_open_now . "</span>";

            })
            ->editColumn('blocked' , function ($record)
            {
                if ($record->blocked == 'no')
                    return "<button data-target='#healthcare-entity-status-change' data-toggle='modal' data-url='" . route('healthcareEntity.entity_status_change' , $record->id) . "'  class='btn badge bg-success'><i class='fa fa-check'></i> Validé</button>";
                else
                    return "<button data-target='#healthcare-entity-status-change' data-toggle='modal' data-url='" . route('healthcareEntity.entity_status_change' , $record->id) . "' class='btn badge bg-warning'><i class='fa fa-close'></i>Bloqué</button>";
            })
            ->editColumn('created_at' , fn($record) => $record->created_at->format('Y-M-d'))
            ->editColumn('expired_at' , function ($record)
            {
                return "<button data-target='#healthcare-expiration-change' data-toggle='modal' data-url='" . route('healthcareEntity.set_expiration_day' , $record->id) . "' data-min='" .  $record->expired_at->format('Y-m-d\TH:i') . "'  class='btn badge bg-warning'><i class='fa fa-check'></i> " . $record->expired_at->format('Y-M-d') ."</button>";
            })
            ->rawColumns(["is open","actions" , 'blocked' , 'expired_at'])
            ->setRowClass(function ($record)
            {
                if($record->expired_at > Carbon::now())
                    return "bg-success";
                        else
                    return  "bg-warning";
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(HealthcareEntity $model): QueryBuilder
    {
        return $model->newQuery()->where('type' , $this->request()->segment(3));
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('healthcareentity-table')
                    ->columns($this->getColumns())
                    ->ajax(
                        [
                            "url"  => route("healthcareEntity.get_index" , $this->request()->segment(3))
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
            Column::make('email')->title(__('Email'))->searchable(true)->orderable(true),
            Column::make('blocked')->title(__('Blocked'))->searchable(true)->orderable(true),
            Column::make('address')->title(__('Address'))->searchable(true)->orderable(true),
            Column::make('expired_at')->title(__('Epiration account'))->searchable(true)->orderable(true),
            Column::make('created_at')->title(__('created_at'))->searchable(true)->orderable(true),
            "is open",
            'actions',
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'HealthcareEntity_' . date('YmdHis');
    }
}
