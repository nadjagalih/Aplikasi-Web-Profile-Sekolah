<?php

namespace App\Http\Controllers;

use App\Models\TenagaMedis;
use Illuminate\Http\Request;

class TenagaMedisController extends Controller
{
    public function index()
    {
        $tenagaMedis = TenagaMedis::with('poliklinik')->where('status', 'Aktif')->get();
        return view('tenaga-medis.index', [
            'tenagaMedis' => $tenagaMedis
        ]);
    }

    public function detail($id)
    {
        $tenagaMedis = TenagaMedis::with('poliklinik')->findOrFail($id);
        return view('tenaga-medis.detail', [
            'tenagaMedis' => $tenagaMedis
        ]);
    }
}
