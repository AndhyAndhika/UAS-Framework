@extends('template')
@section('content')
    <h3 class="mt-4">MASTER CUSTOMER</h3>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">/ customer</li>
    </ol>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div id="TestingAja"></div>
                <div class="col">
                    <button class="btn btn-success mb-2 float-end" onclick="AddCustomer()"><i class="fa-solid fa-plus"></i> Customer</button>
                </div>
            </div>
            <div class="table-responsive">
                <table id="Table_Customer" class="table table-striped-columns table-hover table-bordered display w-100"
                    style="overflow-x: scroll">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>KODE</th>
                            <th>NAME</th>
                            <th>EMAIL</th>
                            <th>MEMBER TYPE</th>
                            <th nowrap="nowrap" width="100px">ACTION</th>
                        </tr>
                    </thead>
                </table>
            </div>

            <script>
                $(function() {
                    var table = $('#Table_Customer').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: "{{ url('/customer') }}",
                        columns: [
                            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                            {data: 'kode', name: 'kode'},
                            {data: 'name', name: 'name'},
                            {data: 'email', name: 'email'},
                            {data: 'member', name: 'member'},
                            {data: 'action', name: 'action', orderable: false, searchable: false},
                        ],
                        "columnDefs": [
                            { className: "text-center", "targets": [ 0 ] },
                            { className: "text-uppercase", "targets": [ 4 ] },
                            { className: "text-center nowrap", "targets": [ 5 ] },
                        ],
                    });
                });

                function AddCustomer(){
                    $("#staticBackdropLabel").html('New Customer');
                    $("#staticBackdrop").modal("show");
                    $("#page").html('Loading...');
                    $.get('/modal/customer', {}, function (data, status) {
                        $("#page").html(data);
                    });
                }

                function EditCustomer(xx){
                    $("#staticBackdropLabel").html('Edit Customer');
                    $("#staticBackdrop").modal("show");
                    $("#page").html('Loading...');
                    $.get('/modal/customer', {}, function (data, status) {
                        $("#page").html(data);
                        $("#member").val('Loading...');
                        $("#name").val('Loading...');
                        $("#email").val('Loading...');
                        $.ajax({
                            method: "POST",
                            dataType: "json",
                            url: "{{ url('/api/customer') }}",
                            data: {
                                _token: "{{ csrf_token() }}",
                                kodeRahasia: xx,
                            },
                            success: function (data) {
                                $("form").attr("action", "{{ url('/modal/customer/update') }}");
                                $("#member").val(data.member);
                                $("#member").trigger('change');
                                $("#name").val(data.name);
                                $("#email").val(data.email);
                                $("#tambahaninputan").html(
                                    '<input type="hidden" name="kodeRahasia" value="' + data.id + '">'
                                );
                            },
                        });
                    });
                }

                function DeleteCustomer(xx){
                    $.ajax({
                        method: "POST",
                        dataType: "json",
                        url: "{{ url('/api/customer-delete') }}",
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
                    window.location.href = "{{ url('/customer') }}";
                }
            </script>
        </div>
    </div>
@endsection
