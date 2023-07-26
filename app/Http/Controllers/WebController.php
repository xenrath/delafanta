<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class WebController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::get();
        $produks = Produk::orderBy('id', 'desc')->get();

        // return json_decode($produks->first()->gambar)[0];

        return view('home', compact('kategoris', 'produks'));
    }

    public function produk()
    {
        $kategoris = Kategori::get();
        
        return view('produk');
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
}
