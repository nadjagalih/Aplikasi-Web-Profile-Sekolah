<?php

namespace App\Http\Controllers;

use App\Models\AlurPelayanan;
use Illuminate\Http\Request;

class AlurPelayananController extends Controller
{
    public function index()
    {
        // Get single alur pelayanan record
        $alurPelayanan = AlurPelayanan::where('status', 'Aktif')->first();
            
        return view('alur-pelayanan.index', compact('alurPelayanan'));
    }
}
