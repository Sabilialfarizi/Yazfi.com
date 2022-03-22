@extends('layouts.master', ['title' => 'List Purchase'])

@section('content')
<div class="row">
    <div class="col-md-4">
        <h1 class="page-title">List Purchase</h1>
    </div>
</div>

<x-alert></x-alert>
<form action="{{ route('purchasing.listpurchase.index') }}" method="get">
    <div class="row filter-row">
        <div class="col-sm-6 col-md-3">
            <div class="form-group form-focus">
                <label class="focus-label">From</label>
                <div class="cal-icon">
                    <input class="form-control floating datetimepicker" type="text" name="from" required>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <div class="form-group form-focus">
                <label class="focus-label">To</label>
                <div class="cal-icon">
                    <input class="form-control floating datetimepicker" type="text" name="to" required>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <button type="submit" class="btn btn-success btn-block">Search</button>
        </div>
    </div>
</form>

<div class="row">
    <div class="col-sm-12">
        <div class="table-responsive">
            <table class="table table-bordered table-striped custom-table report" id="listpurchase" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Invoice</th>
                        <th>Di Ajukan</th>
                        <th>Tanggal</th>
                        <th>Total Item</th>
                        <th>Jumlah</th>
                        <th>Jumlah Bayar</th>
                        <th>Status Pembayaran</th>
                    </tr>
                </thead>

                <tbody>
                    
                </tbody>
            <tfoot></tfoot>
            </table>
        </div>
    </div>
</div>
@stop


@section('footer')
<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function () {
        $.noConflict();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#listpurchase thead tr')
            .clone(true)
            .addClass('filters')
            .appendTo('#listpurchase thead');

        var table = $('#listpurchase').DataTable({
            processing: true,
            serverSide: true,
            orderCellsTop: true,
            fixedHeader: true,
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'copy',
                    className: 'btn-default',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'excel',
                    className: 'btn-default',
                    title: 'Laporan List Purchase',
                    messageTop: 'Tanggal  {{ request("from") }} - {{ request("to") }}',
                    footer: true,
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdf',
                    className: 'btn-default',
                    title: 'Laporan List Purchase',
                    messageTop: 'Tanggal {{ request("from") }} - {{ request("to") }}',
                    footer: true,
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'print',
                    className: 'btn-default',
                    title: 'Laporan List Purchase',
                    messageTop: 'Tanggal {{ request("from") }} - {{ request("to") }}',
                    footer: true,
                    exportOptions: {
                        columns: ':visible'
                    }
                },
            ],
            initComplete: function () {
                var api = this.api();

                // For each column
                api
                    .columns()
                    .eq(0)
                    .each(function (colIdx) {
                        // Set the header cell to contain the input element
                        var cell = $('.filters th').eq(
                            $(api.column(colIdx).header()).index()
                        );
                        var title = $(cell).text();
                        $(cell).html('<input type="text" placeholder="' + title + '" />');

                        // On every keypress in this input
                        $(
                                'input',
                                $('.filters th').eq($(api.column(colIdx).header()).index())
                            )
                            .off('keyup change')
                            .on('keyup change', function (e) {
                                e.stopPropagation();

                                // Get the search value
                                $(this).attr('title', $(this).val());
                                var regexr =
                                    '({search})';
                                // $(this).parents('th').find('select').val();

                                var cursorPosition = this.selectionStart;
                                // Search the column for that value
                                api
                                    .column(colIdx)
                                    .search(
                                        this.value != '' ?
                                        regexr.replace('{search}', '(((' + this.value +
                                            ')))') :
                                        '',
                                        this.value != '',
                                        this.value == ''
                                    )
                                    .draw();

                                $(this)
                                    .focus()[0]
                                    .setSelectionRange(cursorPosition, cursorPosition);
                            });
                    });
            },
           
            ajax: {
                url: '/admin/ajax/ajax_listpurchase',
                get: 'get'

            },
           
            
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'no_purchase',
                    name: 'no_purchase'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'tanggal',
                    name: 'tanggal'
                },
                {
                    data: 'total',
                    name: 'total'
                },
             
                {
                    data: 'pembelian',
                    name: 'pembelian',
                    render: $.fn.dataTable.render.number('.', ',', 0, 'Rp.')
                },
                {
                    data: 'pembelian_purchase',
                    name: 'pembelian_purchase',
                    render: $.fn.dataTable.render.number('.', ',', 0, 'Rp.')
                },
                {
                    data: 'status',
                    name: 'status',
                    
                },
            
           
            ],
           



        })
    })

</script>
@stop