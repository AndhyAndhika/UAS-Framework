@extends('template')
@section('content')
<h3 class="mt-4">TRANSACTION DATA</h3>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">/ Transaction</li>
</ol>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div id="TestingAja"></div>
            <div class="col">
                <button class="btn btn-success mb-2 float-end" onclick="AddTransaction()"><i class="fa-solid fa-plus"></i> Transaction</button>
            </div>
        </div>
        <div class="table-responsive">
            <table id="Table_Transaction" class="table table-striped-columns table-hover table-bordered display w-100"
                style="overflow-x: scroll">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>KODE TRANSACTION</th>
                        <th>KODE CUSTOMER</th>
                        <th>KODE ITEM</th>
                        <th>RATE (/ITEM)</th>
                        <th>ORDER QTY</th>
                        <th>DELIVERY QTY</th>
                        <th>MINUS DELIVERY QTY</th>
                        <th>PRICE</th>
                        <th>STATUS</th>
                        <th nowrap="nowrap" width="100px">ACTION</th>
                    </tr>
                </thead>
            </table>
        </div>
        <script>
             $(function() {
                var table = $('#Table_Transaction').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ url('/transaction') }}",
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                        {data: 'kode', name: 'kode'},
                        {data: 'kodeCustomer', name: 'kodeCustomer'},
                        {data: 'kodeBarang', name: 'kodeBarang'},
                        {data: 'harga_deal', name: 'harga_deal'},
                        {data: 'qty_order', name: 'qty_order'},
                        {data: 'qty_delivery', name: 'qty_delivery'},
                        {data: 'MinusDelivery', name: 'MinusDelivery'},
                        {data: 'total_harga', name: 'total_harga'},
                        {data: 'status', name: 'status'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ],
                    "columnDefs": [
                        { className: "text-center", "targets": [ 0 ] },
                        { className: "text-uppercase", "targets": [ 4 ] },
                        { className: "nowrap", "targets": [ 8 ] },
                        { className: "text-center nowrap", "targets": [ 9 ] },
                    ],
                });
            });

            function AddTransaction(){
                $("#staticBackdropLabel").html('New Transaction');
                $("#staticBackdrop").modal("show");
                $("#page").html('Loading...');
                $.get('/modal/transaction', {}, function (data, status) {
                    $("#page").html(data);
                });
            }

            function EditTransaction(xx){
                $("#staticBackdropLabel").html('Edit Transaction');
                $("#staticBackdrop").modal("show");
                $("#page").html('Loading...');
                $.get('/modal/transaction', {}, function (data, status) {
                    $("#page").html(data);
                    $("#customer").val('Loading...');
                    $("#items").val('Loading...');
                    $("#qty_order").val('Loading...');
                    $.ajax({
                        method: "POST",
                        dataType: "json",
                        url: "{{ url('/api/transaction') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            kodeRahasia: xx,
                        },
                        success: function (data) {
                            $("form").attr("action", "{{ url('/modal/transaction/update') }}");
                            $("#customer").val(data.id_user);
                            $("#customer").trigger('change');
                            $("#customer").attr("readonly", "readonly");
                            $("#customer").attr("disabled", "disabled");
                            $("#items").val(data.id_inventory);
                            $("#items").trigger('change');
                            $("#items").attr("readonly", "readonly");
                            $("#items").attr("disabled", "disabled");
                            $("#qty_order").val(data.qty_order)
                            $("#tambahaninputan").html(
                                '<input type="hidden" name="kodeRahasia" value="' + data.id + '">'
                            );
                        },
                    });
                });
            }

            function DeleteTransaction(xx){
                $.ajax({
                    method: "POST",
                    dataType: "json",
                    url: "{{ url('/api/transaction-delete') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        kodeRahasia: xx,
                    },
                    success: function (data) {

                    }
                });
                alert('Data Anda Berhasil Dihapus...');
                window.location.href = "{{ url('/transaction') }}";
            }
        </script>
    </div>
</div>
@endsection
