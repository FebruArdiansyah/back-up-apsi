@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        {{ trans('cruds.history_order.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-history_order">
                <thead>
                    <tr>
                        <th width="10"></th>
                        <th>{{ trans('cruds.history_order.fields.id') }}</th>
                        <th>{{ trans('cruds.history_order.fields.name') }}</th>
                        <th>{{ trans('cruds.history_order.fields.email') }}</th>
                        <th>{{ trans('cruds.history_order.fields.no_telepon') }}</th>
                        <th>{{ trans('cruds.history_order.fields.alamat') }}</th>
                        <th>{{ trans('cruds.history_order.fields.product') }}</th>
                        <th>{{ trans('cruds.history_order.fields.pengiriman') }}</th>
                        <th>{{ trans('cruds.history_order.fields.total') }}</th>
                        <th>{{ trans('cruds.history_order.fields.status') }}</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $key => $b)
                        <tr data-entry-id="{{ $b->id }}">
                            <td></td>
                            <td>{{ $b->id ?? '' }}</td>
                            <td>{{ $b->name ?? '' }}</td>
                            <td>{{ $b->email ?? '' }}</td>
                            <td>{{ $b->no_telepon ?? '' }}</td>
                            <td>{{ $b->alamat ?? '' }}</td>
                            <td>
                                <ul>
                                    @foreach($b->products as $product)
                                        <li>{{ $product->name }} - {{ $product->pivot->quantity }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>{{ $b->pengiriman ?? '' }}</td>
                            <td>
                                {{ $b->total ?? '' }}
                            </td>
                            <td>
                                <span class="badge @if($b->status == 'unpaid') badge-danger @else badge-success @endif">
                                    {{ $b->status ?? '' }}
                                </span>
                            </td>
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<style>
    .status-cancel {
        background-color: red;
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        font-weight: bold;
    }

    .status-order {
        background-color: green;
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        font-weight: bold;
    }

    .status-selesai {
        background-color: green;
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        font-weight: bold;
    }
</style>
@endsection

@section('scripts')
@parent
<script>
    $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
        

        $.extend(true, $.fn.dataTable.defaults, {
            orderCellsTop: true,
            order: [[ 1, 'desc' ]],
            pageLength: 100,
        });
        
        let table = $('.datatable-history_order:not(.ajaxTable)').DataTable({ buttons: dtButtons })
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
    })
</script>
@endsection
