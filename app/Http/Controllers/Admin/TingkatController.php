<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tingkat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TingkatController extends Controller
{
    function index()
    {
        $tingkats = Tingkat::get();

        return view('admin.tingkat.index', compact('tingkats'));
    }

    function create()
    {
        return view('admin.tingkat.create');
    }

    function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required'
        ], [
            'nama.required' => 'Nama tingkat harus diisi!',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return back()->withInput()->with('error', $error);
        }

        Tingkat::create($request->all());

        return redirect('admin/tingkat')->with('success', 'Berhasil menambahkan Tingkat');
    }

    public function edit($id)
    {
        $tingkat = Tingkat::where('id', $id)->first();

        return view('admin.tingkat.edit', compact('tingkat'));
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required'
        ], [
            'nama.required' => 'Nama tingkat harus diisi!',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return back()->withInput()->with('error', $error);
        }

        Tingkat::where('id', $id)->update([
            'nama' => $request->nama
        ]);

        return redirect('admin/tingkat')->with('success', 'Berhasil mengubah Tingkat');
    }

    public function destroy($id)
    {
        $tingkat = Tingkat::where('id', $id)->first();
        $tingkat->delete();

        return redirect('admin/tingkat')->with('success', 'Berhasil menghapus Tingkat');
    }
}
