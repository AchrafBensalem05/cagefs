<?php

namespace App\DataTables\Front;

use App\Models\Article;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SaveAnnouncesDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('actions', fn($record) => "<a target='_blank' href='".route("patient.get_article_details" ,$record->id)."' class='btn btn-sm text-white btn-success'>Voir</a>")
            ->rawColumns(['actions'])
            ->editColumn('created_at' , fn($record) => $record->created_at->format('Y-M-d'))
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Article $model): QueryBuilder
    {
        return $model->newQuery()->with(['favorites'])->whereHas('favorites' , function ($builder)
        {
            $builder->where('user_id' , Auth::guard('patient')->id())->orderBy('created_at' , 'desc');
        });
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('saveannounces-table')
                    ->columns($this->getColumns())
                    ->ajax([
                                "url"  => route("patient.get_saved_announces_data"),
                        ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->title("#")->searchable(true)->orderable(true),
            Column::make('title')->title(__('Description'))->searchable(true)->orderable(true),
            Column::make('section')->title(__('Post Section'))->searchable(true)->orderable(true),
            Column::make('medication_type')->title(__('Search or Offer'))->searchable(true)->orderable(true),
            Column::make('created_at')->title(__('created_at'))->searchable(true)->orderable(true),
            'actions'
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'SaveAnnounces_' . date('YmdHis');
    }
}
