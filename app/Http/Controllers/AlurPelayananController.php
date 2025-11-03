<?php

namespace App\Http\Controllers;

use App\Models\AlurPelayanan;
use Illuminate\Http\Request;

class AlurPelayananController extends Controller
{
    public function index()
    {
        $alurPelayanans = AlurPelayanan::where('status', 'Aktif')
            ->orderBy('urutan', 'asc')
            ->get();
            
        return view('alur-pelayanan.index', compact('alurPelayanans'));
    }
}
