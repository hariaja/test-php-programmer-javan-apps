<?php

namespace App\DataTables;

use App\Models\Family;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
// use Yajra\DataTables\Html\Button;
// use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class FamilyDataTable extends DataTable
{
  /**
   * Build the DataTable class.
   *
   * @param QueryBuilder $query Results from query() method.
   */
  public function dataTable(QueryBuilder $query): EloquentDataTable
  {
    return (new EloquentDataTable($query))
      ->addIndexColumn()
      ->addColumn('parent', fn ($row) => $row->parent ? $row->parent->name : '-')
      ->addColumn('children_count', fn ($row) => "{$row->children->count()} Anak")
      ->addColumn('action', 'families.action')
      ->rawColumns([
        'action',
      ]);
  }

  /**
   * Get the query source of dataTable.
   */
  public function query(Family $model): QueryBuilder
  {
    return $model->newQuery()->oldest('name');
  }

  /**
   * Optional method if you want to use the html builder.
   */
  public function html(): HtmlBuilder
  {
    return $this->builder()
      ->setTableId('family-table')
      ->columns($this->getColumns())
      ->addTableClass([
        'table',
        'table-striped',
        'table-bordered',
        'table-hover',
      ])
      ->processing(true)
      ->retrieve(true)
      ->serverSide(true)
      ->autoWidth(false)
      ->pageLength(5)
      ->responsive(true)
      ->lengthMenu([5, 10, 20])
      ->orderBy(1);
  }

  /**
   * Get the dataTable columns definition.
   */
  public function getColumns(): array
  {
    return [
      Column::make('DT_RowIndex')
        ->title(trans('#'))
        ->orderable(false)
        ->searchable(false)
        ->width('10%')
        ->addClass('text-center'),
      Column::make('name')
        ->title(trans('Nama'))
        ->addClass('text-center'),
      Column::make('gender')
        ->title(trans('Jenis Kelamin'))
        ->addClass('text-center'),
      Column::make('parent')
        ->title(trans('Orang Tua'))
        ->addClass('text-center'),
      Column::make('children_count')
        ->title(trans('Jumlah Anak'))
        ->addClass('text-center'),
      Column::computed('action')
        ->exportable(false)
        ->printable(false)
        ->width('15%')
        ->addClass('text-center'),
    ];
  }

  /**
   * Get the filename for export.
   */
  protected function filename(): string
  {
    return 'Family_' . date('YmdHis');
  }
}
