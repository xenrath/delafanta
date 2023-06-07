<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetailPesanan;
use App\Models\Pelanggan;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PesananController extends Controller
{
    public function index()
    {
        $pesanans = Pesanan::get();

        return view('admin.pesanan.index', compact('pesanans'));
    }

    public function create()
    {
        $pelanggan = Pelanggan::get();

        return view('admin.pesanan.create', compact('pelanggan'));
    }

    public function store(Request $request)
    {
        $validasi_pelanggan = Validator::make($request->all(), [
            'nama_pelanggan' => 'required',
            'telp_pelanggan' => 'required',
            'asal_pelanggan' => 'required',
        ], [
            'nama_pelanggan.required' => 'Nama pelanggan belum diisi!',
            'telp_pelanggan.required' => 'Nomor telepon pelanggan belum diisi!',
            'asal_pelanggan.required' => 'Asal pelanggan belum diisi!',
        ]);

        $error_pelanggans = array();

        if ($validasi_pelanggan->fails()) {
            foreach ($validasi_pelanggan->errors()->all() as $error) {
                array_push($error_pelanggans, $error);    
            }
        }

        $cek_telp = substr($request->telp_pelanggan, 0, 1);

        if ($cek_telp == '0') {
            array_push($error_pelanggans, 'Format nomor telepon salah!');
        }

        $error_pesanans = array();
        $data_pesanans = collect();

        for ($i = 0; $i < count($request->produk); $i++) {
            $validasi_pesanan = Validator::make($request->all(), [
                'produk.' . $i => 'required',
                'harga.' . $i => 'required',
                'jumlah.' . $i => 'required',
            ]);

            if ($validasi_pesanan->fails()) {
                array_push($error_pesanans, "Pemesanan nomor " . $i + 1 . " belum dilengkapi!");
            }

            $produk = is_null($request->produk[$i]) ? '' : $request->produk[$i];
            $harga = is_null($request->harga[$i]) ? '' : $request->harga[$i];
            $jumlah = is_null($request->jumlah[$i]) ? '' : $request->jumlah[$i];
            $total = is_null($request->total[$i]) ? '' : $request->total[$i];

            $data_pesanans->push(['produk' => $produk, 'harga' => $harga, 'jumlah' => $jumlah, 'total' => $total]);
        }

        if ($error_pelanggans || $error_pesanans) {
            return back()
                ->withInput()
                ->with('error_pelanggans', $error_pelanggans)
                ->with('error_pesanans', $error_pesanans)
                ->with('data_pesanans', $data_pesanans);
        }

        $cek_pelanggan = Pelanggan::where('telp', $request->telp_pelanggan)->first();

        if ($cek_pelanggan) {
            $pelanggan = $cek_pelanggan;
        } else {
            $pelanggan = Pelanggan::create([
                'nama' => $request->nama_pelanggan,
                'telp' => $request->telp_pelanggan,
                'asal' => $request->asal_pelanggan,
            ]);
        }

        $pesanan = Pesanan::create([
            'pelanggan_id' => $pelanggan->id
        ]);

        if ($pesanan) {
            foreach ($data_pesanans as $data_pesanan) {
                DetailPesanan::create([
                    'produk' => $data_pesanan['produk'],
                    'harga' => $data_pesanan['harga'],
                    'jumlah' => $data_pesanan['jumlah'],
                    'total' => $data_pesanan['total'],
                ]);
            }
        }

        return redirect('admin/pesanan')->with('Berhasil menambahkan Pesanan');
    }

    public function edit($id)
    {
        $pesanan = Pesanan::where('id', $id)->first();
        $kategoris = Kategori::get();
        $sub_kategoris = SubKategori::get();
        $warnas = Warna::get();

        return view('admin.pesanan.edit', compact('pesanan', 'kategoris', 'warnas'));
    }
}
