<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class WebController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function produk()
    {
        return view('produk');
    }

    public function kontak()
    {
        return view('kontak');
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
