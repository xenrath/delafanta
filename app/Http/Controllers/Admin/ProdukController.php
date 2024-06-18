<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetailProduk;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\SubKategori;
use App\Models\Warna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::get();
        // return $produks;

        return view('admin.produk.index', compact('produks'));
    }

    public function create()
    {
        $kategoris = Kategori::get();
        $sub_kategoris = SubKategori::get();

        return view('admin.produk.create', compact('kategoris', 'sub_kategoris'));
    }

    public function store(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'kategori_id' => 'required',
        //     'subkategori_id' => 'required',
        //     'gambar' => 'required',
        // ], [
        //     'kategori_id.required' => 'Kategori harus dipilih!',
        //     'subkategori_id.required' => 'Sub Kategori harus dipilih!',
        //     'gambar.required' => 'Gambar harus ditambahkan!',
        // ]);

        // if ($validator->fails()) {
        //     $errors = $validator->errors()->all();
        //     return back()->withInput()->with('errors', $errors);
        // }

        $kode = $this->kode();
        $gambar = $this->namagambar($request->gambar, $kode);
        
        Produk::create(array_merge($request->all(), [
            'kode' => $kode,
            'subkategori_id' => $request->subkategori_id,
            'gambar' => $gambar
        ]));

        return redirect('admin/produk')->with('success', 'Berhasil menambahkan Produk');
    }

    public function show($id)
    {
        $produk = Produk::where('id', $id)->first();

        return view('admin.produk.show', compact('produk'));
    }

    public function edit($id)
    {
        $produk = Produk::where('id', $id)->first();
        $kategoris = Kategori::get();
        $sub_kategoris = SubKategori::get();
        $warnas = Warna::get();

        return view('admin.produk.edit', compact('produk', 'kategoris', 'warnas'));
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::where('id', $id)->first();

        $validasi_produk = Validator::make($request->all(), [
            'kategori_id' => 'required',
            'subkategori_id' => 'required',
            'warna' => 'required',
        ], [
            'kategori_id.required' => 'Kategori harus dipilih!',
            'subkategori_id.required' => 'Sub Kategori harus dipilih!',
            'warna.required' => 'Warna harus dipilih!',
        ]);

        $error_produks = array();

        if ($validasi_produk->fails()) {
            foreach ($validasi_produk->errors()->all() as $error) {
                array_push($error_produks, $error);
            }
        }

        $error_details = array();
        $data_produks = collect();

        $sub_kategori = SubKategori::where('id', $request->subkategori_id)->first();

        if ($sub_kategori) {
            for ($i = 0; $i < count($request->ukuran); $i++) {
                if ($sub_kategori->jenis) {
                    $validasi_detail = Validator::make($request->all(), [
                        'tingkat.' . $i => 'required',
                        'ukuran.' . $i => 'required',
                        'jumlah.' . $i => 'required',
                        'harga.' . $i => 'required',
                    ]);
                } else {
                    $validasi_detail = Validator::make($request->all(), [
                        'ukuran.' . $i => 'required',
                        'jumlah.' . $i => 'required',
                        'harga.' . $i => 'required',
                    ]);
                }

                if ($validasi_detail->fails()) {
                    array_push($error_details, "Detail produk nomor " . $i + 1 . " belum dilengkapi!");
                }

                $tingkat = is_null($request->tingkat[$i]) ? '' : $request->tingkat[$i];
                $ukuran = is_null($request->ukuran[$i]) ? '' : $request->ukuran[$i];
                $jumlah = is_null($request->jumlah[$i]) ? '' : $request->jumlah[$i];
                $harga = is_null($request->harga[$i]) ? '' : $request->harga[$i];

                $data_produks->push(['tingkat' => $tingkat, 'ukuran' => $ukuran, 'jumlah' => $jumlah, 'harga' => $harga]);
            }
        }

        if ($error_produks || $error_details) {
            return back()
                ->withInput()
                ->with('error_produks', $error_produks)
                ->with('error_details', $error_details)
                ->with('data_produks', $data_produks);
        }

        $kode = $produk->kode;
        $gambar = $produk->gambar;

        return $gambar;

        $update = Produk::where('id', $id)->update([
            'subkategori_id' => $request->subkategori_id,
            'warna' => json_encode($request->warna),
        ]);

        if ($update) {
            if ($request->has('gambar')) {
                foreach ($request->file('gambar') as $key => $g) {
                    $nama = $this->namagambar($g, $kode);
                    $g->storeAs('public/uploads', $nama);
                    $gambar[] = $nama;
                }
            }

            Produk::where('id', $id)->update([
                'gambar' => json_encode($gambar)
            ]);

            DetailProduk::where('produk_id', $produk->id)->delete();

            foreach ($data_produks as $data_produk) {
                $harga = str_replace('.', '', $data_produk['harga']);
                DetailProduk::create([
                    'produk_id' => $produk->id,
                    'tingkat' => $data_produk['tingkat'],
                    'ukuran' => $data_produk['ukuran'],
                    'jumlah' => $data_produk['jumlah'],
                    'harga' => $harga,
                ]);
            }
        }

        return redirect('admin/produk')->with('success', 'Berhasil menambahkan Produk');
    }

    public function destroy($id)
    {
        $produk = Produk::where('id', $id)->first();
        $produk->delete();

        return back()->with('success', 'Berhasil menghapus Produk');
    }

    public function kode()
    {
        $karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789';
        $kode  = substr(str_shuffle($karakter), 0, 5);
        return $kode;
    }

    public function namagambar($data, $kode)
    {
        $ext = $data->getClientOriginalExtension();
        $nama = 'produk/' . $kode . '.' . $ext;
        $data->storeAs('public/uploads/', $nama);

        return $nama;
    }

    public function unduh(Request $request, $id)
    {
        $produk = Produk::where('id', $id)->first();

        $gambar = json_decode($produk->gambar)[$request->key];
        $filepath = public_path('storage/uploads/') . $gambar;

        return response()->download($filepath);
    }

    public function sub_kategori($id)
    {
        $sub_kategoris = SubKategori::where('kategori_id', $id)->get();

        return json_decode($sub_kategoris);
    }

    public function jenis_ukuran($id)
    {
        $sub_kategori = SubKategori::where('id', $id)->first();

        return json_decode($sub_kategori);
    }

    public function delete_gambar($id, $i)
    {
        $produk = Produk::where('id', $id)->first();
        $gambar = $produk->gambar;

        unset($gambar[$i]);

        Produk::where('id', $id)->update([
            'gambar' => $gambar
        ]);

        return $gambar;
    }
}
