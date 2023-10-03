<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Unduhans;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class WebController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::with('sub_kategoris:nama,kategori_id,slug')->get();

        $produks = Produk::join('sub_kategoris', 'produks.subkategori_id', '=', 'sub_kategoris.id')
            ->select(
                'produks.kode',
                'produks.gambar',
                'sub_kategoris.nama as subkategori_nama'
            )->orderBy('produks.id', 'desc')->get();

        return view('home', compact('kategoris', 'produks'));
    }

    public function produk(Request $request, $slug = null)
    {
        $kategoris = Kategori::with('sub_kategoris')->get();
        $filter = $request->filter;

        if (is_null($slug)) {
            $produks = Produk::orderBy('id', 'desc')->get();
        } else {
            $produks = Produk::whereHas('subkategori', function ($subkategori) use ($slug) {
                $subkategori->where('slug', $slug);
            })->get();
        }

        return view('produk', compact('kategoris', 'produks'));
    }

    public function kontak()
    {
        $kategoris = Kategori::get();
        return view('kontak', compact('kategoris'));
    }

    public function hubungi()
    {
        $device = new Agent();

        if ($device->isMobile()) {
            return redirect()->away('https://wa.me/+6285328481969');
        } else {
            return redirect()->away('https://web.whatsapp.com/send?phone=+6285328481969');
        }
    }

    public function unduh($kode)
    {
        $produk = Produk::where('kode', $kode)->first();
        $unduhan = Unduhans::where('produk_id', $produk->id)->first();
        if ($unduhan) {
            Unduhans::where('produk_id', $produk->id)->update([
                'jumlah' => $unduhan->jumlah + 1
            ]);
        } else {
            Unduhans::create([
                'produk_id' => $produk->id,
                'jumlah' => 1
            ]);
        }
        $gambar = public_path('storage/uploads/') . $produk->gambar;

        return response()->download($gambar);
    }
}
