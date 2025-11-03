<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\Berita;
use App\Models\Sambutan;
use Illuminate\Support\Facades\Http;

class BerandaController extends Controller
{
    public function index()
    {
        // Ambil sambutan kepala puskesmas yang aktif
        $sambutan = Sambutan::where('status', 'Aktif')->first();
        
        // Ambil data SKM dari API
        $skm = null;
        try {
            $response = Http::timeout(5)->get('https://skm.trenggalekkab.go.id/api/survey-organisasi/NDYwMDAwMDAwMA');
            if ($response->successful()) {
                $apiData = $response->json();
                if (isset($apiData['data'])) {
                    $data = $apiData['data'];
                    $skm = [
                        'unit_kerja' => $data['unit_kerja'] ?? 'N/A',
                        'total_skor' => $data['total_skor'] ?? 0,
                        'grade' => $data['grade'] ?? 'N/A',
                        'keterangan' => $data['keterangan'] ?? 'N/A',
                        'periode_survey' => $data['periode_survey'] ?? 'N/A',
                        'total_responden' => $data['total_responden'] ?? 0,
                        'jenis_kelamin' => $data['jenis_kelamin'] ?? [],
                        'pendidikan' => $data['pendidikan'] ?? [],
                        'pekerjaan' => $data['pekerjaan'] ?? [],
                        'usia' => $data['usia'] ?? [],
                    ];
                }
            }
        } catch (\Exception $e) {
            // Jika gagal mengambil data dari API, set null
            $skm = null;
        }

        return view('index', [
            'sliders'     => Slider::all(),
            'beritas'     => Berita::where('status_id', 2)->latest()->take(4)->get(),
            'sambutan'    => $sambutan,
            'skm'         => $skm
        ]);
    }
}
