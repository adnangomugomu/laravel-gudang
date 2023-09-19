<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'title' => 'Halaman About',
            'header' => 'Tentang Kami',
        ];
        $data['tim_terbaru'] = User::orderBy('created_at','desc')->take(3)->get();
        $data['produk_terbaru'] = Produk::where('nama','like',"%$request->q%")
        ->orWhere('deskripsi','like',"%$request->q%")
        ->orderBy('created_at','desc')->paginate(6);
        return view('about', $data);
    }
}
