<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Warna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WarnaController extends Controller
{
    function index()
    {
        $warnas = Warna::get();

        return view('admin.warna.index', compact('warnas'));
    }

    function create()
    {
        return view('admin.warna.create');
    }

    function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required'
        ], [
            'nama.required' => 'Nama warna harus diisi!',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return back()->withInput()->with('error', $error);
        }

        Warna::create($request->all());

        return redirect('admin/warna')->with('success', 'Berhasil menambahkan Warna');
    }

    public function edit($id)
    {
        $warna = Warna::where('id', $id)->first();

        return view('admin.warna.edit', compact('warna'));
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required'
        ], [
            'nama.required' => 'Nama warna harus diisi!',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return back()->withInput()->with('error', $error);
        }

        Warna::where('id', $id)->update([
            'nama' => $request->nama
        ]);

        return redirect('admin/warna')->with('success', 'Berhasil mengubah Warna');
    }

    public function destroy($id)
    {
        $warna = Warna::where('id', $id)->first();
        $warna->delete();

        return redirect('admin/warna')->with('success', 'Berhasil menghapus Warna');
    }
}
