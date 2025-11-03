<?php

namespace App\Http\Controllers;

use App\Models\JadwalDokter;
use Illuminate\Http\Request;

class JadwalDokterController extends Controller
{
    public function index()
    {
        $jadwal = JadwalDokter::with('dokter', 'poliklinik')
            ->where('status', 'Aktif')
            ->orderBy('hari')
            ->orderBy('jam_mulai')
            ->get();
            
        return view('jadwal-dokter.index', [
            'jadwal' => $jadwal
        ]);
    }
}
