<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Home',
            'header' => 'Rekap Data',
        ];

        $data['total_user'] = User::count();
        $data['total_produk'] = Produk::count();
        $data['total_qty'] = Produk::sum('qty');
        return view('home', $data);
    }   
}
