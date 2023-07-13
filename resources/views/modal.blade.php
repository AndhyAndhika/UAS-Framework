@switch(Route::current()->getName())
    @case('Customer_Modal')
        <form action="{{ url('/modal/customer/save') }}" method="POST" enctype="multipart/form-data" onsubmit="DisabledButtomSubmit()">
            @csrf
            <div class="row">
                <div class="col-6">
                    <div class="col-12 mb-3">
                        <label for="Nama">Customer Name <sup>*</sup></label>
                        <input type="text" class="form-control" name="name" id="name" aria-describedby="nameHelp" required>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="email">Customer Email <sup>*</sup></label>
                        <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" required>
                    </div>
                </div>
                <div class="col-6">
                    <div class="col-12 mb-3">
                        <label for="member">Member Type <sup>*</sup></label>
                        <select class="form-select" id="member" name="member" required>
                            <option value="">Open this select menu</option>
                            <option value="daily">DAILY</option>
                            <option value="weekly">WEEKLY</option>
                            <option value="vip">VIP</option>
                            <option value="vvip">VVIP</option>
                            <option value="vvvip">VVVIP</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div id="tambahaninputan"></div>
                    <button type="submit" id="submit" class="btn btn-primary float-end"><i
                            class="fa-regular fa-floppy-disk"></i> Save</button>
                </div>
            </div>
        </form>
    @break
    @case('inventory_Modal')
        <form action="{{ url('/modal/inventory/save') }}" method="POST" enctype="multipart/form-data" onsubmit="DisabledButtomSubmit()">
            @csrf
            <div class="row">
                <div class="col-6">
                    <div class="col-12 mb-3">
                        <label for="nama_barang">Nama Barang <sup>*</sup></label>
                        <input type="text" class="form-control" name="nama_barang" id="nama_barang" aria-describedby="nama_barangHelp" required>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="harga_barang">Harga Barang <sup>*</sup></label>
                        <input type="number" class="form-control" name="harga_barang" id="harga_barang" min="0" value="0" aria-describedby="harga_barangHelp" required>
                    </div>
                </div>
                <div class="col-6">
                    <div class="col-12 mb-3">
                        <label for="stock_barang">Stock Barang <sup>*</sup></label>
                        <input type="number" class="form-control" name="stock_barang" id="stock_barang" min="0" value="0" aria-describedby="stock_barangHelp" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div id="tambahaninputan"></div>
                    <button type="submit" id="submit" class="btn btn-primary float-end"><i class="fa-regular fa-floppy-disk"></i> Save</button>
                </div>
            </div>
        </form>
    @break
    @case('transaction_Modal')
        <form action="{{ url('/modal/transaction/save') }}" method="POST" enctype="multipart/form-data" onsubmit="DisabledButtomSubmit()">
            @csrf
            <div class="row">
                <div class="col-6">
                    <div class="col-12 mb-3">
                        <div class="mb-3">
                            <label for="customer">Customer <sup>*</sup></label>
                            <select class="form-control mt-1" name="customer" id="customer" required>
                                <option class="dropdown-item form-control" selected disabled>-- Choose Customer --
                                </option>
                                @foreach (App\Models\User::all(); as $item)
                                    <option class="dropdown-item form-control" value="{{ $item->id }}">
                                        {{ $item->kode }} - {{ $item->name }}</option>
                                @endforeach
                            </select>
                            <script>
                                $(document).ready(function() {
                                    $("#customer").select2({
                                        dropdownParent: $("#staticBackdrop")
                                    });
                                });
                            </script>
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <div class="mb-3">
                            <label for="items">Items Name<sup>*</sup></label>
                            <select class="form-control mt-1" name="items" id="items" required>
                                <option class="dropdown-item form-control" selected disabled>-- Choose items --
                                </option>
                                @foreach (App\Models\inventory::all(); as $item)
                                    <option class="dropdown-item form-control" value="{{ $item->id }}">
                                        {{ $item->kode }} - {{ $item->nama_barang }}</option>
                                @endforeach
                            </select>
                            <script>
                                $(document).ready(function() {
                                    $("#items").select2({
                                        dropdownParent: $("#staticBackdrop")
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="col-12 mb-3">
                        <label for="qty_order">Order Qty <sup>*</sup></label>
                        <input type="number" class="form-control" name="qty_order" id="qty_order" min="0" value="0" aria-describedby="qty_orderHelp" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div id="tambahaninputan"></div>
                    <button type="submit" id="submit" class="btn btn-primary float-end"><i class="fa-regular fa-floppy-disk"></i> Save</button>
                </div>
            </div>
        </form>
    @break
    @case('delivery_order_Modal')
        <form action="{{ url('/modal/delivery-order/save') }}" method="POST" enctype="multipart/form-data" onsubmit="DisabledButtomSubmit()">
            @csrf
            <div class="row">
                <div class="col-6">
                    <div class="col-12 mb-3">
                        <div class="mb-3">
                            <label for="id_transaksi">Transaksi <sup>*</sup></label>
                            <select class="form-control mt-1" name="id_transaksi" id="id_transaksi" required>
                                <option class="dropdown-item form-control" selected disabled>-- Choose Transaksi --
                                </option>
                                @foreach (App\Models\Transaction::all(); as $item)
                                    <option class="dropdown-item form-control" value="{{ $item->id }}">
                                        {{ $item->kode }} - {{ $item->Inventory->nama_barang }} - {{ $item->User->name }} - {{ $item->qty_order }} Pcs</option>
                                @endforeach
                            </select>
                            <script>
                                $(document).ready(function() {
                                    $("#id_transaksi").select2({
                                        dropdownParent: $("#staticBackdrop")
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="col-12 mb-3">
                        <label for="qty">Order Qty <sup>*</sup></label>
                        <input type="number" class="form-control" name="qty" id="qty" min="0" value="0" aria-describedby="qty_orderHelp" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div id="tambahaninputan"></div>
                    <button type="submit" id="submit" class="btn btn-primary float-end"><i class="fa-regular fa-floppy-disk"></i> Save</button>
                </div>
            </div>
        </form>
    @break
    @default

@endswitch
