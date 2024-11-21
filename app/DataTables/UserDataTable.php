<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('Actions', fn($record) => "  ".
                (Auth::user()->can('user-edit') ?
                    "<a href='".route("users.edit" , $record->id)."' class='btn btn-info btn-sm mr-1'><i class='fas fa-pencil-alt'></i>Modifier</a>" : "").
                (Auth::user()->can('user-delete') ?
                    "<a href='".route("users.show" , $record->id)."' class='btn btn-sm btn-danger'><i class='fas fa-trash'></i> Supprimer</a>" : "") .
                " ")
            ->addColumn("Rôles" ,function ($record){
                $render = "";
                if($record->roles->count())
                {
                    $roles = $record->roles;
                    foreach ($roles as $role) {$render .= "<span class='badge badge-success'>" . $role->name . "</span>";}
                }
                return $render ;
            })
            ->editColumn('created_at' , fn($record) => $record->created_at->format('Y-M-d'))
            ->rawColumns(["Actions" , 'Rôles'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('user-table')
                    ->columns($this->getColumns())
                    ->ajax([
                        "url"  => route("users.get_index")
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
            Column::make('email')->title(__('Email'))->searchable(true)->orderable(true),
            "Rôles",
            Column::make('created_at')->title(__('created_at'))->searchable(true)->orderable(true),
            'Actions',
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'User_' . date('YmdHis');
    }
}
