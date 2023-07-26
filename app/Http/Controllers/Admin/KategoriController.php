<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class KategoriController extends Controller
{
    function index()
    {
        $kategoris = Kategori::get();

        return view('admin.kategori.index', compact('kategoris'));
    }

    function create()
    {
        return view('admin.kategori.create');
    }

    function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required'
        ], [
            'nama.required' => 'Nama kategori harus diisi!',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return back()->withInput()->with('error', $error);
        }

        Kategori::create(array_merge($request->all(), [
            'slug' => Str::slug($request->nama)
        ]));

        return redirect('admin/kategori')->with('success', 'Berhasil menambahkan Kategori');
    }

    public function show($id)
    {
        $kategori = Kategori::where('id')->first();

        return view('admin.kategori.show', compact('kategori'));
    }

    public function edit($id)
    {
        $kategori = Kategori::where('id', $id)->first();

        return view('admin.kategori.edit', compact('kategori'));
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required'
        ], [
            'nama.required' => 'Nama kategori harus diisi!',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return back()->withInput()->with('error', $error);
        }

        Kategori::where('id', $id)->update([
            'nama' => $request->nama,
            'slug' => Str::slug($request->nama)
        ]);

        return redirect('admin/kategori')->with('success', 'Berhasil mengubah Kategori');
    }

    public function destroy($id)
    {
        $kategori = Kategori::where('id', $id)->first();
        $kategori->delete();

        return redirect('admin/kategori')->with('success', 'Berhasil menghapus Kategori');
    }
}
