<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ukuran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UkuranController extends Controller
{
    function index()
    {
        $ukurans = Ukuran::get();

        return view('admin.ukuran.index', compact('ukurans'));
    }

    function create()
    {
        return view('admin.ukuran.create');
    }

    function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required'
        ], [
            'nama.required' => 'Nama ukuran harus diisi!',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return back()->withInput()->with('error', $error);
        }

        Ukuran::create($request->all());

        return redirect('admin/ukuran')->with('success', 'Berhasil menambahkan Ukuran');
    }

    public function edit($id)
    {
        $ukuran = Ukuran::where('id', $id)->first();

        return view('admin.ukuran.edit', compact('ukuran'));
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required'
        ], [
            'nama.required' => 'Nama ukuran harus diisi!',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return back()->withInput()->with('error', $error);
        }

        Ukuran::where('id', $id)->update([
            'nama' => $request->nama
        ]);

        return redirect('admin/ukuran')->with('success', 'Berhasil mengubah Ukuran');
    }

    public function destroy($id)
    {
        $ukuran = Ukuran::where('id', $id)->first();
        $ukuran->delete();

        return redirect('admin/ukuran')->with('success', 'Berhasil menghapus Ukuran');
    }
}
