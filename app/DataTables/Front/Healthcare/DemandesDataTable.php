<?php

namespace App\DataTables\Front\Healthcare;

use App\Models\Article;
use App\Models\Demande;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DemandesDataTable extends DataTable
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
            ->editColumn('author_id' , fn($record) => optional($record->user)->name )
            ->editColumn('collecting_time' , fn($record) => __($record->collecting_time))
            ->editColumn("ordonnance" , function ($record)
            {
                $result = "";
                if ($record->pin == 'active')
                    $result .= "<a href='" . route('healthcare.pin_medication_demand' , $record->id) . "' class='btn btn-warning text-white me-1' title='pin this demand' ><i class='fa fa-check'></i></a>";
                $result .= "  <a target='_blank' href='" . $record->getFirstMediaUrl('gallery') . "' class='btn btn-primary text-white'><i class='fa fa-download'></i>" . "" ."</a>";
                return $result;
            })
            ->editColumn("payments" , function ($record)
            {
                $payments = json_decode($record->payments , true);
                $result = '';
                if(is_array($payments))
                    foreach ($payments as $item)
                        $result .= "<span class='badge bg-info m-1'>" . $item . "</span>";
                else
                    $result = "Not specified";
                return $result;
            })
            ->editColumn("medication" , function ($record)
            {
                $medication = json_decode($record->medication , true);
                $result = '';
                if(is_array($medication))
                    foreach ($medication as $item)
                        $result .= "<span class='badge bg-info m-1'>" . $item . "</span>";
                else
                    $result = "Not specified";
                return $result;
            })
            ->setRowClass(function ($record)
            {
                if($record->pin == "pinned" and $record->pinner_id == Auth::guard('healthcare')->user()->id)
                    return "bg-success";
            })
            ->rawColumns(['ordonnance' , 'payments' , 'medication'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Article $model): QueryBuilder
    {
        return $model->newQuery()->where('section'   , 'medication_demand')->where("healthcare_id" , Auth::guard('healthcare')->id())->orderBy('created_at' , 'desc');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('demandes-table')
                    ->columns($this->getColumns())
                    ->ajax(
                        [
                            "url"  => route("healthcare.get_medication_demands_data"),
                        ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->title("#")->searchable(true)->orderable(true),
            Column::make('title')->title(__('Patient Name'))->searchable(true)->orderable(true),
            Column::make('status')->title(__('status'))->searchable(true)->orderable(true),
            Column::make('payments')->title(__('Accepted Payments'))->searchable(true)->orderable(true),
            Column::make('medication')->title(__('Medication'))->searchable(true)->orderable(true),
            Column::make('collecting_time')->title(__('Collection time'))->searchable(true)->orderable(true),
            Column::make('created_at')->title(__('created_at'))->searchable(true)->orderable(true),
            Column::make('author_id')->title(__('Patient'))->searchable(true)->orderable(true),
            'ordonnance'
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Demandes_' . date('YmdHis');
    }
}
