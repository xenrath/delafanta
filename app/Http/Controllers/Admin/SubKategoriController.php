<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\SubKategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubKategoriController extends Controller
{
    function index()
    {
        $sub_kategoris = SubKategori::get();

        return view('admin.sub-kategori.index', compact('sub_kategoris'));
    }

    function create()
    {
        $kategoris = Kategori::get();

        return view('admin.sub-kategori.create', compact('kategoris'));
    }

    function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kategori_id' => 'required',
            'nama' => 'required',
            'jenis' => 'required'
        ], [
            'kategori_id.required' => 'Kategori harus dipilih!',
            'nama.required' => 'Nama sub kategori harus diisi!',
            'jenis.required' => 'Jenis ukuran harus dipilih!',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return back()->withInput()->with('error', $error);
        }

        SubKategori::create($request->all());

        return redirect('admin/sub-kategori')->with('success', 'Berhasil menambahkan Sub Kategori');
    }

    public function edit($id)
    {
        $sub_kategori = SubKategori::where('id', $id)->first();
        $kategoris = Kategori::get();

        return view('admin.sub-kategori.edit', compact('sub_kategori', 'kategoris'));
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'kategori_id' => 'required',
            'nama' => 'required'
        ], [
            'kategori_id.required' => 'Kategori harus dipilih!',
            'nama.required' => 'Nama sub kategori harus diisi!',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return back()->withInput()->with('error', $error);
        }

        SubKategori::where('id', $id)->update([
            'kategori_id' => $request->kategori_id,
            'nama' => $request->nama
        ]);

        return redirect('admin/sub-kategori')->with('success', 'Berhasil mengubah Sub Kategori');
    }

    public function destroy($id)
    {
        $sub_kategori = SubKategori::where('id', $id)->first();
        $sub_kategori->delete();

        return redirect('admin/sub-kategori')->with('success', 'Berhasil menghapus Sub Kategori');
    }
}
