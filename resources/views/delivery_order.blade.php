@extends('template')
@section('content')
<h3 class="mt-4">DELIVERY ORDER</h3>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">/ Delivery Order</li>
</ol>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div id="TestingAja"></div>
            <div class="col">
                <button class="btn btn-success mb-2 float-end" onclick="AddDelivery()"><i class="fa-solid fa-plus"></i> Customer</button>
            </div>
        </div>
        <div class="table-responsive">
            <table id="Table_Delivery" class="table table-striped-columns table-hover table-bordered display w-100"
                style="overflow-x: scroll">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>KODE DELIVERY</th>
                        <th>KODE TRANSAKSI</th>
                        <th>JENIS BARANG</th>
                        <th>CUSTOMER</th>
                        <th>QTY</th>
                        <th nowrap="nowrap" width="100px">ACTION</th>
                    </tr>
                </thead>
            </table>
        </div>

        <script>
            $(function() {
                var table = $('#Table_Delivery').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ url('/delivery-order') }}",
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                        {data: 'kode', name: 'kode'},
                        {data: 'kode_transaksi', name: 'kode_transaksi'},
                        {data: 'nama_barang', name: 'nama_barang'},
                        {data: 'customer', name: 'customer'},
                        {data: 'qty', name: 'qty'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ],
                    "columnDefs": [
                        { className: "text-center", "targets": [ 0 ] },
                        { className: "text-center nowrap", "targets": [ 5 ] },
                    ],
                });
            });

            function AddDelivery(){
                $("#staticBackdropLabel").html('New Delivery');
                $("#staticBackdrop").modal("show");
                $("#page").html('Loading...');
                $.get('/modal/delivery-order', {}, function (data, status) {
                    $("#page").html(data);
                });
            }

            function EditDelivery(xx){
                $("#staticBackdropLabel").html('Edit Delivery');
                $("#staticBackdrop").modal("show");
                $("#page").html('Loading...');
                $.get('/modal/delivery-order', {}, function (data, status) {
                    $("#page").html(data);
                    $("#id_transaksi").val('Loading...');
                    $("#qty").val('Loading...');
                    $.ajax({
                        method: "POST",
                        dataType: "json",
                        url: "{{ url('/api/delivery-order') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            kodeRahasia: xx,
                        },
                        success: function (data) {
                            $("form").attr("action", "{{ url('/modal/delivery-order/update') }}");
                            $("#id_transaksi").val(data.id_transaksi);
                            $("#id_transaksi").trigger('change');
                            $("#id_transaksi").attr("readonly", "readonly");
                            $("#id_transaksi").attr("disabled", "disabled");
                            $("#qty").val(data.qty);
                            $("#tambahaninputan").html(
                                '<input type="hidden" name="kodeRahasia" value="' + data.id + '">'
                            );
                        },
                    });
                });
            }

            function DeleteDelivery(xx){
                $.ajax({
                    method: "POST",
                    dataType: "json",
                    url: "{{ url('/api/delivery-order-delete') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        kodeRahasia: xx,
                    },
                    success: function(data) {
                       alert("Berhasil:", data); // Menampilkan data respon jika permintaan berhasil
                        // Lakukan tindakan lain berdasarkan data respon jika diperlukan
                    },
                    error: function(xhr, status, error) {
                    }

                });
                alert('Data Anda Berhasil Dihapus...');
                window.location.href = "{{ url('/delivery-order') }}";
            }
        </script>
    </div>
</div>
@endsection
