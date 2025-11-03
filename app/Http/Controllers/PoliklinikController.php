<?php

namespace App\Http\Controllers;

use App\Models\Poliklinik;
use Illuminate\Http\Request;

class PoliklinikController extends Controller
{
    public function index()
    {
        $poliklinik = Poliklinik::with('tenagaMedis')->get();
        return view('poliklinik.index', [
            'poliklinik' => $poliklinik
        ]);
    }

    public function detail($id)
    {
        $poliklinik = Poliklinik::with('tenagaMedis', 'jadwalDokter')->findOrFail($id);
        return view('poliklinik.detail', [
            'poliklinik' => $poliklinik
        ]);
    }
}
