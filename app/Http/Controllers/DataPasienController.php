<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\JenisKelamin;
use App\Models\Agama;
use App\Models\Pekerjaan;
use Illuminate\Http\Request;

class DataPasienController extends Controller
{
    public function index()
    {
        // Data untuk grafik berdasarkan jenis kelamin
        $dataJenisKelamin = Pasien::with('jenisKelamin')
            ->selectRaw('jenis_kelamin_id, count(*) as total')
            ->groupBy('jenis_kelamin_id')
            ->get();
        
        // Data untuk grafik berdasarkan agama
        $dataAgama = Pasien::with('agama')
            ->selectRaw('agama_id, count(*) as total')
            ->groupBy('agama_id')
            ->get();
        
        // Data untuk grafik berdasarkan pekerjaan
        $dataPekerjaan = Pasien::with('pekerjaan')
            ->selectRaw('pekerjaan_id, count(*) as total')
            ->groupBy('pekerjaan_id')
            ->get();
        
        $totalPasien = Pasien::count();
        
        return view('data-pasien.index', [
            'dataJenisKelamin' => $dataJenisKelamin,
            'dataAgama' => $dataAgama,
            'dataPekerjaan' => $dataPekerjaan,
            'totalPasien' => $totalPasien
        ]);
    }
}
