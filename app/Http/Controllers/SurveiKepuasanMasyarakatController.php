<?php

namespace App\Http\Controllers;

use App\Models\SurveiKepuasanMasyarakat;
use App\Models\RespondenSKM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SurveiKepuasanMasyarakatController extends Controller
{
    public function index()
    {
        $surveiAktif = SurveiKepuasanMasyarakat::where('status', 'Aktif')
            ->orWhere('status', 'Selesai')
            ->orderBy('created_at', 'DESC')
            ->first();
        
        if (!$surveiAktif) {
            return view('skm.index', [
                'survei' => null,
                'statistik' => null
            ]);
        }
        
        // Ambil statistik responden
        $statistik = [
            'total_responden' => RespondenSKM::where('survei_id', $surveiAktif->id)->count(),
            'jenis_kelamin' => RespondenSKM::where('survei_id', $surveiAktif->id)
                ->select('jenis_kelamin_id', DB::raw('count(*) as total'))
                ->with('jenisKelamin')
                ->groupBy('jenis_kelamin_id')
                ->get(),
            'pendidikan' => RespondenSKM::where('survei_id', $surveiAktif->id)
                ->select('pendidikan', DB::raw('count(*) as total'))
                ->groupBy('pendidikan')
                ->get(),
            'pekerjaan' => RespondenSKM::where('survei_id', $surveiAktif->id)
                ->select('pekerjaan_id', DB::raw('count(*) as total'))
                ->with('pekerjaan')
                ->groupBy('pekerjaan_id')
                ->get(),
        ];
        
        return view('skm.index', [
            'survei' => $surveiAktif,
            'statistik' => $statistik
        ]);
    }
    
    public function form()
    {
        $surveiAktif = SurveiKepuasanMasyarakat::where('status', 'Aktif')->first();
        
        if (!$surveiAktif) {
            return redirect()->back()->with('error', 'Tidak ada survei yang sedang aktif');
        }
        
        return view('skm.form', [
            'survei' => $surveiAktif
        ]);
    }
    
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'survei_id' => 'required|exists:survei_kepuasan_masyarakat,id',
            'jenis_kelamin_id' => 'required',
            'pendidikan' => 'required',
            'pekerjaan_id' => 'required',
            'nilai_1' => 'required|integer|min:1|max:4',
            'nilai_2' => 'required|integer|min:1|max:4',
            'nilai_3' => 'required|integer|min:1|max:4',
            'nilai_4' => 'required|integer|min:1|max:4',
            'nilai_5' => 'required|integer|min:1|max:4',
            'nilai_6' => 'required|integer|min:1|max:4',
            'nilai_7' => 'required|integer|min:1|max:4',
            'nilai_8' => 'required|integer|min:1|max:4',
            'nilai_9' => 'required|integer|min:1|max:4',
        ]);
        
        // Hitung nilai rata-rata
        $nilaiRataRata = (
            $validated['nilai_1'] + 
            $validated['nilai_2'] + 
            $validated['nilai_3'] + 
            $validated['nilai_4'] + 
            $validated['nilai_5'] + 
            $validated['nilai_6'] + 
            $validated['nilai_7'] + 
            $validated['nilai_8'] + 
            $validated['nilai_9']
        ) / 9;
        
        $validated['nilai_rata_rata'] = $nilaiRataRata;
        $validated['nama'] = $request->nama;
        $validated['umur'] = $request->umur;
        $validated['komentar'] = $request->komentar;
        
        RespondenSKM::create($validated);
        
        // Update total responden dan nilai SKM di survei
        $this->updateSurveiStatistik($validated['survei_id']);
        
        return redirect('/skm')->with('success', 'Terima kasih telah mengisi survei kepuasan masyarakat');
    }
    
    private function updateSurveiStatistik($surveiId)
    {
        $survei = SurveiKepuasanMasyarakat::find($surveiId);
        $totalResponden = RespondenSKM::where('survei_id', $surveiId)->count();
        $nilaiSKM = RespondenSKM::where('survei_id', $surveiId)->avg('nilai_rata_rata');
        
        // Konversi ke skala 100
        $nilaiSKM = ($nilaiSKM / 4) * 100;
        
        // Tentukan predikat
        $predikat = '';
        if ($nilaiSKM >= 88.31) {
            $predikat = 'Sangat Baik (A)';
        } elseif ($nilaiSKM >= 76.61) {
            $predikat = 'Baik (B)';
        } elseif ($nilaiSKM >= 65.00) {
            $predikat = 'Kurang Baik (C)';
        } else {
            $predikat = 'Tidak Baik (D)';
        }
        
        $survei->update([
            'total_responden' => $totalResponden,
            'nilai_skm' => round($nilaiSKM, 2),
            'predikat' => $predikat
        ]);
    }
}
