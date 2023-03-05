<?php

namespace App\DataTables;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MenuDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->editColumn('name', function($row) {
                return "<i class='$row->icon'></i> $row->name";
            })
            ->addColumn('link', function($row) {
                return "<span class='badge bg-info'>$row->link<span>";
            })
            ->addColumn('action', function ($row) {
                return "<button class='btn btn-sm btn-primary' onclick='edit($row->id)'><i class='mdi mdi-pencil'></i></button> 
                    <button class='btn btn-sm btn-danger' onclick='destroy($row->id)'><i class='mdi mdi-trash-can'></i></button>";
            })
            ->addColumn('status', function ($row) {
                if ($row->status == 1) {
                    return "<button class='btn btn-sm btn-success' onclick='change_status($row->id, $row->status)'>Avtive</button>";
                } else {
                    return "<button class='btn btn-sm btn-danger' onclick='change_status($row->id, $row->status)'>Inactive</button>";
                }
            })
            ->addColumn('category', function ($row) {
                if($row->categoryMenu->name == " ") {
                    return "";
                }
                return "<span class='badge bg-primary'>" . $row->categoryMenu->name . "</span>";
            })
            ->addColumn('parent', function($row) {
                if($row->parent) {
                    return "<span class='badge bg-success'>" . $row->parent->name . "</span>";
                }
                return "";
            })
            ->rawColumns(['link', 'name', 'status', 'action', 'category', 'parent'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Menu $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Menu $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('menu-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->selectStyleSingle();
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')->title('No')->searchable(false)->orderable(false),
            Column::make('name'),
            Column::make('link'),
            Column::make('category')->addClass('text-center'),
            Column::computed('parent')->addClass('text-center'),
            Column::computed('status')->addClass('text-center'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(160)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Menu_' . date('YmdHis');
    }
}
