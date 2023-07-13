<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Delivery;
use App\Models\Inventory;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class MainController extends Controller
{
    public function OpenModal()
    {
        return view('modal');
    }

    public function index(){
        return view('home');
    }

    public function customer_index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('id', 'kode', 'name', 'email', 'member')->latest()->get();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn = '<a class="btn fa-solid fa-pen-to-square fa-lg text-warning" onclick="EditCustomer(' . $data->id . ')"></a> | <a class="btn fa-solid fa-trash fa-lg text-danger" onclick="DeleteCustomer(' . $data->id . ')"></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('customer');
    }

    public function customer_save(Request $request)
    {
        // dd($request);
        $a = date('Y-m-d');
        $max = User::selectRaw('max(kode) AS ed')->whereDate('created_at', '>=', $a)->get()->first();
        $kode = substr($max->ed, 14);
        $ed = 'PLNGN';
        $date = date("dmY");

        $kode++;

        $kodeauto = $ed . $date . sprintf("%04s", $kode);
        // dd($kodeauto);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'member' => 'required',
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/customer')->with('gagal_validasi', 'gagal_validasi');
        }

        $insert = User::create([
            'name' => $request->name,
            'kode' => $kodeauto,
            'email' => $request->email,
            'member' => $request->member,
            'password' => Hash::make('admin'),
        ]);

        if ($insert) {
            return redirect('/customer')->with('berhasil_input', 'berhasil_input');
        }

        return redirect('/customer')->with('gagal_validasi', 'gagal_validasi');
    }

    public function customer_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'member' => 'required',
            'email' => 'required',
            "kodeRahasia" => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/customer')->with('gagal_validasi', 'gagal_validasi');
        }

        $insert = User::find($request->kodeRahasia)->update([
            'name' => $request->name,
            'email' => $request->email,
            'member' => $request->member,
        ]);

        if ($insert) {
            return redirect('/customer')->with('berhasil_input', 'berhasil_input');
        }

        return redirect('/customer')->with('gagal_validasi', 'gagal_validasi');
    }

    public function inventory_index(Request $request)
    {
        if ($request->ajax()) {
            $data = Inventory::select('id', 'kode', 'nama_barang', 'harga_barang', 'stock_barang')->latest()->get();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn = '<a class="btn fa-solid fa-pen-to-square fa-lg text-warning" onclick="Editinventory(' . $data->id . ')"></a> | <a class="btn fa-solid fa-trash fa-lg text-danger" onclick="Deleteinventory(' . $data->id . ')"></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('inventory');
    }

    public function inventory_save(Request $request)
    {
        $a = date('Y-m-d');
        $max = Inventory::selectRaw('max(kode) AS ed')->whereDate('created_at', '>=', $a)->get()->first();
        $kode = substr($max->ed, 14);
        $ed = 'BARNG';
        $date = date("dmY");

        $kode++;

        $kodeauto = $ed . $date . sprintf("%04s", $kode);
        $validator = Validator::make($request->all(), [
            "nama_barang" => 'required',
            "harga_barang" => 'required',
            "stock_barang" => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/inventory')->with('gagal_validasi', 'gagal_validasi');
        }

        if ($request->harga_barang <= 0 || $request->stock_barang <= 0) {
            return redirect('/inventory')->with('gagal_validasi', 'gagal_validasi');
        }

        $insert = Inventory::create([
            'nama_barang' => $request->nama_barang,
            'kode' => $kodeauto,
            'harga_barang' => $request->harga_barang,
            'stock_barang' => $request->stock_barang,
        ]);

        if ($insert) {
            return redirect('/inventory')->with('berhasil_input', 'berhasil_input');
        }
        return redirect('/inventory')->with('gagal_validasi', 'gagal_validasi');
    }

    public function inventory_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "nama_barang" => 'required',
            "harga_barang" => 'required',
            "stock_barang" => 'required',
            "kodeRahasia" => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/inventory')->with('gagal_validasi', 'gagal_validasi');
        }

        if ($request->harga_barang <= 0 || $request->stock_barang <= 0) {
            return redirect('/inventory')->with('gagal_validasi', 'gagal_validasi');
        }

        $insert = Inventory::find($request->kodeRahasia)->update([
            'nama_barang' => $request->nama_barang,
            'harga_barang' => $request->harga_barang,
            'stock_barang' => $request->stock_barang,
        ]);

        if ($insert) {
            return redirect('/inventory')->with('berhasil_input', 'berhasil_input');
        }
        return redirect('/inventory')->with('gagal_validasi', 'gagal_validasi');
    }

    public function transaction_index(Request $request)
    {
        if ($request->ajax()) {
            $data = Transaction::with(['Inventory', 'User'])->latest()->get();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($data) {
                    if ($data->status != 3) {
                        $btn = '<a class="btn fa-solid fa-pen-to-square fa-lg text-warning" onclick="EditTransaction(' . $data->id . ')"></a> | <a class="btn fa-solid fa-trash fa-lg text-danger" onclick="DeleteTransaction(' . $data->id . ')"></a>';
                    } else {
                        $btn = '<i class="btn fa-solid fa-check-double fa-lg text-success"></i>';
                    }
                    return $btn;
                })
                ->addColumn('status', function ($status) {
                    //(0; On Progress, 1; On Sending, 2; arrived 3; Success)
                    if ($status->status == 0) {
                        $status = "On Progress";
                    } else if ($status->status == 1) {
                        $status = "On Delivery";
                    } else if ($status->status == 2) {
                        $status = "Arrived";
                    } else if ($status->status == 3) {
                        $status = "Success";
                    } else {
                        $status = "Not Status Defined";
                    }
                    return $status;
                })
                ->addColumn('kodeCustomer', function ($data) {
                    return $kode_transaksi = $data->User->kode;
                })
                ->addColumn('kodeBarang', function ($data) {
                    return $KodeBarang = $data->Inventory->kode;
                })
                ->addColumn('MinusDelivery', function ($data) {
                    return $MinusDelivery = $data->qty_delivery - $data->qty_order;
                })
                ->rawColumns(['action', '$status', 'MinusDelivery', 'kodeCustomer', 'kodeBarang'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('transaction');
    }

    public function transaction_save(Request $request)
    {
        // dd($request);
        $a = date('Y-m-d');
        $max = Transaction::selectRaw('max(kode) AS ed')->whereDate('created_at', '>=', $a)->get()->first();
        $kode = substr($max->ed, 14);
        $ed = 'TRNSC';
        $date = date("dmY");

        $kode++;

        $kodeauto = $ed . $date . sprintf("%04s", $kode);
        $validator = Validator::make($request->all(), [
            "customer" => 'required',
            "items" => 'required',
            "qty_order" => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/transaction')->with('gagal_validasi', 'gagal_validasi');
        }

        if ($request->qty_order <= 0) {
            return redirect('/transaction')->with('gagal_validasi', 'gagal_validasi');
        }
        $users = User::find($request->customer);
        $inventory = Inventory::find($request->items);

        $insert = Transaction::create([
            'kode' => $kodeauto,
            'id_user' => $request->customer,
            'id_inventory' => $request->items,
            'harga_deal' =>  $inventory->harga_barang,
            'qty_order' =>  $request->qty_order,
            'qty_delivery' =>  0,
            'total_harga' => $inventory->harga_barang * $request->qty_order,
            'status' => 0, //(0; On Progress, 1; On Sending, 2; arrived 3; Success)
        ]);

        if ($insert) {
            return redirect('/transaction')->with('berhasil_input', 'berhasil_input');
        }
        return redirect('/transaction')->with('gagal_validasi', 'gagal_validasi');
    }

    public function transaction_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "qty_order" => 'required',
            "kodeRahasia" => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/transaction')->with('gagal_validasi', 'gagal_validasi');
        }

        if ($request->qty_order <= 0) {
            return redirect('/transaction')->with('gagal_validasi', 'gagal_validasi');
        }

        $old = Transaction::find($request->kodeRahasia);

        $insert =  Transaction::find($request->kodeRahasia)->update([
            'qty_order' =>  $request->qty_order,
            'total_harga' => $old->harga_deal * $request->qty_order,
        ]);

        if ($insert) {
            return redirect('/transaction')->with('berhasil_input', 'berhasil_input');
        }
        return redirect('/transaction')->with('gagal_validasi', 'gagal_validasi');
    }

    public function delivery_order_index(Request $request)
    {
        if ($request->ajax()) {
            $data = Delivery::with(['Transaction'])->latest()->get();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn = '<a class="btn fa-solid fa-pen-to-square fa-lg text-warning" onclick="EditDelivery(' . $data->id . ')"></a> | <a class="btn fa-solid fa-trash fa-lg text-danger" onclick="DeleteDelivery(' . $data->id . ')"></a>';
                    // if ($data->status != 3) {
                    // } else {
                    //     $btn = '<i class="btn fa-solid fa-check-double fa-lg text-success"></i>';
                    // }
                    return $btn;
                })
                ->addColumn('kode_transaksi', function ($data) {
                    return $kode_transaksi = $data->Transaction->kode;
                })
                ->addColumn('nama_barang', function ($data) {
                    return $nama_barang = $data->Transaction->Inventory->nama_barang;
                })
                ->addColumn('customer', function ($data) {
                    return $customer = $data->Transaction->User->kode . " | " . $data->Transaction->User->name;
                })
                ->rawColumns(['action', 'customer', 'kode_transaksi', 'nama_barang'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('delivery_order');
    }

    public function delivery_order_save(Request $request)
    {
        // dd($request);
        $a = date('Y-m-d');
        $max = Delivery::selectRaw('max(kode) AS ed')->whereDate('created_at', '>=', $a)->get()->first();
        $kode = substr($max->ed, 14);
        $ed = 'DLVRY';
        $date = date("dmY");

        $kode++;

        $kodeauto = $ed . $date . sprintf("%04s", $kode);
        $validator = Validator::make($request->all(), [
            "id_transaksi" => 'required',
            "qty" => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/delivery-order')->with('gagal_validasi', 'gagal_validasi');
        }

        if ($request->qty <= 0) {
            return redirect('/delivery-order')->with('gagal_validasi', 'gagal_validasi');
        }

        $get = Transaction::find($request->id_transaksi);

        if ($get->qty_delivery <= 0) {
            $update = Transaction::find($request->id_transaksi)->update([
                'qty_delivery' =>  $request->qty,
                'status' => 1,
            ]);
        } else if ($get->qty_order > ($get->qty_delivery + $request->qty)) {
            $update = Transaction::find($request->id_transaksi)->update([
                'qty_delivery' => $get->qty_delivery + $request->qty,
                'status' => 1,
            ]);
        } else if ($get->qty_order == ($get->qty_delivery + $request->qty)) {
            $update = Transaction::find($request->id_transaksi)->update([
                'qty_delivery' => $get->qty_delivery + $request->qty,
                'status' => 3,
            ]);
        } else {
            return redirect('/delivery-order')->with('gagal_validasi', 'gagal_validasi');
        }
        $insert =  Delivery::create([
            'kode' =>  $kodeauto,
            'id_transaksi' =>  $request->id_transaksi,
            'qty' =>  $request->qty,
        ]);

        if ($insert) {
            return redirect('/delivery-order')->with('berhasil_input', 'berhasil_input');
        }
        return redirect('/delivery-order')->with('gagal_validasi', 'gagal_validasi');
    }

    public function delivery_order_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "kodeRahasia" => 'required',
            "qty" => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/delivery-order')->with('gagal_validasi', 'gagal_validasi');
        }

        if ($request->qty <= 0) {
            return redirect('/delivery-order')->with('gagal_validasi', 'gagal_validasi');
        }



        $getDelivery = Delivery::find($request->kodeRahasia);
        $getTrans = Delivery::select(DB::raw('SUM(qty) as total_delivery'))->where('id_transaksi', $getDelivery->id_transaksi)->get();
        $get = Transaction::find($getDelivery->id_transaksi);

        if ($get->qty_delivery <= 0) {
            $update = Transaction::find($getDelivery->id_transaksi)->update([
                'qty_delivery' =>  $getTrans[0]->total_delivery,
                'status' => 1,
            ]);
        } else if ($get->qty_order >= $getTrans[0]->total_delivery + $request->qty) {
            if ($get->qty_order == $getTrans[0]->total_delivery  + $request->qty) {
                $update = Transaction::find($getDelivery->id_transaksi)->update([
                    'qty_delivery' => $getTrans[0]->total_delivery,
                    'status' => 3,
                ]);
            } else if ($getTrans[0]->total_delivery + $request->qty > $get->qty_order) {
                return redirect('/delivery-order')->with('gagal_validasi', 'gagal_validasi');
            }
            $update = Transaction::find($getDelivery->id_transaksi)->update([
                'qty_delivery' => $getTrans[0]->total_delivery + $request->qty,
                'status' => 1,
            ]);
        } else {
            return redirect('/delivery-order')->with('gagal_validasi', 'gagal_validasi');
        }

        $insert = Delivery::find($request->kodeRahasia)->update([
            'qty' =>  $request->qty,
        ]);

        if ($insert) {
            return redirect('/delivery-order')->with('berhasil_input', 'berhasil_input');
        }
        return redirect('/delivery-order')->with('gagal_validasi', 'gagal_validasi');
    }
}
