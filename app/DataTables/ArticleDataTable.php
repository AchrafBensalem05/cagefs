<?php

namespace App\DataTables;

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

class ArticleDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('actions', fn($record) => "<a href='".route("article.show" , [$record->section , $record->id])."' class='btn btn-sm btn-danger'><i class='fas fa-trash'></i>Delete</a>")
            ->addColumn('reports', function ($record)
            {
                return "<span class='text-danger fw-bolder'>" . $record->reports->count() ."</span>";
            })
            ->editColumn('created_at' , fn($record) => $record->created_at->format('Y-M-d'))
            ->editColumn('pin' , function ($record)
            {
                if ($record->pin == 'active')
                    return "<span  class='badge bg-info' data-bs-target='#patient-article-pin-change' data-bs-toggle='modal'  data-url='" . route('patient-article-pin_change' , $record->id) . "' >". __('Active')."</span>";
                elseif($record->pin == 'request')
                    return "<span  class='badge bg-warning' data-bs-target='#patient-article-pin-change' data-bs-toggle='modal' data-pinner='" . route('patient.get_data' , $record->pinner_id)  ."' data-url='" . route('patient-article-pin_change' , $record->id) . "' >". __('PIN REQUESTED ! ')."</span>";
                elseif($record->pin == 'pinned')
                    return "<span  class='badge bg-primary' data-bs-target='#patient-article-pin-change' data-bs-toggle='modal'  data-url='" . route('patient-article-pin_change' , $record->id) . "' >". __('Pinned ')."</span>";
            })
            ->editColumn('status' , function ($record)
            {
                if ($record->status == 'active')
                    return "<span  class='badge bg-success' data-bs-target='#patient-article-status-change' data-bs-toggle='modal'  data-url='" . route('patient-article-status_change' , $record->id) . "' >" .__('active')."</span>";
                elseif($record->status == 'canceled')
                    return "<span  class='badge bg-danger' data-bs-target='#patient-article-status-change' data-bs-toggle='modal'  data-url='" . route('patient-article-status_change' , $record->id) . "' >". __('canceled')."</span>";
                elseif($record->status == 'done')
                    return "<span  class='badge bg-primary' data-bs-target='#patient-article-status-change' data-bs-toggle='modal'  data-url='" . route('patient-article-status_change' , $record->id) . "' >".__('done')."</span>";

            })
            ->editColumn('language' , function ($record)
            {
                return "<span  class='badge bg-dark'>".__($record->language)."</span>";
            })
            ->rawColumns(['actions','status' , 'language' , 'reports' , 'pin'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Article $model): QueryBuilder
    {
        return $model->newQuery()->with(['reports' , 'likes' , 'favorites'])->where('section' , $this->request()->segment(3));
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('article-table')
                    ->columns($this->getColumns())
                    ->ajax(
                        [
                            "url"  => route("timeline.get_index" , $this->request()->segment(3))
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
            Column::make('title')->title(__('Description'))->searchable(true)->orderable(true),
            Column::make('status')->title(__('status'))->searchable(true)->orderable(true),
            Column::make('language')->title(__('Language'))->searchable(true)->orderable(true),
            Column::make('pin')->title(__('Pin'))->searchable(true)->orderable(true),
            Column::make('created_at')->title(__('created_at'))->searchable(true)->orderable(true),
            'reports',
            'actions'
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Article_' . date('YmdHis');
    }
}
