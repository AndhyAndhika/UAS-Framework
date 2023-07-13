@extends('template')
@section('content')
<h3 class="mt-4">INVENTORY DATA</h3>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">/ Inventory</li>
</ol>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div id="TestingAja"></div>
            <div class="col">
                <button class="btn btn-success mb-2 float-end" onclick="Addinventory()"><i class="fa-solid fa-plus"></i> Item</button>
            </div>
        </div>
        <div class="table-responsive">
            <table id="Table_Barang" class="table table-striped-columns table-hover table-bordered display w-100"
                style="overflow-x: scroll">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>KODE</th>
                        <th>ITEMS NAME</th>
                        <th>PRICE </th>
                        <th>STOCK </th>
                        <th nowrap="nowrap" width="100px">ACTION</th>
                    </tr>
                </thead>
            </table>
        </div>
        <script>
            $(function() {
                var table = $('#Table_Barang').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ url('/inventory') }}",
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                        {data: 'kode', name: 'kode'},
                        {data: 'nama_barang', name: 'nama_barang'},
                        {data: 'harga_barang', name: 'harga_barang'},
                        {data: 'stock_barang', name: 'stock_barang'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ],
                    "columnDefs": [
                        { className: "text-center", "targets": [ 4 ] },
                        { className: "text-uppercase", "targets": [ 3 ] },
                        { className: "text-center nowrap", "targets": [ 5 ] },
                    ],
                });
            });

            function Addinventory(){
                $("#staticBackdropLabel").html('New Item');
                $("#staticBackdrop").modal("show");
                $("#page").html('Loading...');
                $.get('/modal/inventory', {}, function (data, status) {
                    $("#page").html(data);
                });
            }

            function Editinventory(xx){
                $("#staticBackdropLabel").html('Edit Item');
                $("#staticBackdrop").modal("show");
                $("#page").html('Loading...');
                $.get('/modal/inventory', {}, function (data, status) {
                    $("#page").html(data);
                    $("#nama_barang").val('Loading...');
                    $("#harga_barang").val(0);
                    $("#stock_barang").val(0);
                    $.ajax({
                        method: "POST",
                        dataType: "json",
                        url: "{{ url('/api/inventory') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            kodeRahasia: xx,
                        },
                        success: function (data) {
                            $("form").attr("action", "{{ url('/modal/inventory/update') }}");
                            $("#nama_barang").val(data.nama_barang);
                            $("#harga_barang").val(data.harga_barang);
                            $("#stock_barang").val(data.stock_barang);
                            $("#tambahaninputan").html(
                                '<input type="hidden" name="kodeRahasia" value="' + data.id + '">'
                            );
                        },
                    });
                });
            }

            function Deleteinventory(xx){
                $.ajax({
                    method: "POST",
                    dataType: "json",
                    url: "{{ url('/api/inventory-delete') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        kodeRahasia: xx,
                    },
                });
                alert('Data Anda Berhasil Dihapus...');
                    window.location.href = "{{ url('/inventory') }}";
            }
        </script>
    </div>
</div>
@endsection
