<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SurveiKepuasanMasyarakat;
use App\Models\RespondenSKM;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AdminSurveiKepuasanMasyarakatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.skm.index', [
            'survei' => SurveiKepuasanMasyarakat::orderBy('id', 'DESC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.skm.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_survei' => 'required',
            'periode' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
        ], [
            'nama_survei.required' => 'Wajib mengisi nama survei!',
            'periode.required' => 'Wajib mengisi periode!',
            'tanggal_mulai.required' => 'Wajib mengisi tanggal mulai!',
            'tanggal_selesai.required' => 'Wajib mengisi tanggal selesai!',
            'tanggal_selesai.after' => 'Tanggal selesai harus setelah tanggal mulai!',
        ]);

        if($validator->fails()){
            return redirect('/admin/skm/create')
                ->withErrors($validator)
                ->withInput();
        }

        SurveiKepuasanMasyarakat::create([
            'nama_survei' => $request->nama_survei,
            'periode' => $request->periode,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'keterangan' => $request->keterangan,
            'status' => $request->status ?? 'Aktif',
            'user_id' => auth()->user()->id
        ]);

        return redirect('/admin/skm')->with('success', 'Berhasil menambahkan survei');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $survei = SurveiKepuasanMasyarakat::findOrFail($id);
        $responden = RespondenSKM::where('survei_id', $id)
            ->with('jenisKelamin', 'pekerjaan')
            ->orderBy('created_at', 'DESC')
            ->get();
        
        return view('admin.skm.show', [
            'survei' => $survei,
            'responden' => $responden
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $survei = SurveiKepuasanMasyarakat::findOrFail($id);
        return view('admin.skm.edit', [
            'survei' => $survei,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $survei = SurveiKepuasanMasyarakat::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'nama_survei' => 'required',
            'periode' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
        ], [
            'nama_survei.required' => 'Wajib mengisi nama survei!',
            'periode.required' => 'Wajib mengisi periode!',
            'tanggal_mulai.required' => 'Wajib mengisi tanggal mulai!',
            'tanggal_selesai.required' => 'Wajib mengisi tanggal selesai!',
            'tanggal_selesai.after' => 'Tanggal selesai harus setelah tanggal mulai!',
        ]);

        if($validator->fails()){
            return redirect("/admin/skm/{$id}/edit")
                ->withErrors($validator)
                ->withInput();
        }

        $survei->update([
            'nama_survei' => $request->nama_survei,
            'periode' => $request->periode,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'keterangan' => $request->keterangan,
            'status' => $request->status ?? 'Aktif',
            'user_id' => auth()->user()->id
        ]);

        return redirect('/admin/skm')->with('success', 'Berhasil memperbarui survei');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $survei = SurveiKepuasanMasyarakat::findOrFail($id);
        
        // Hapus semua responden terkait
        RespondenSKM::where('survei_id', $id)->delete();
        
        $survei->delete();

        return redirect('/admin/skm')->with('success', 'Berhasil menghapus survei');
    }
    
    /**
     * Delete responden
     */
    public function deleteResponden($id)
    {
        $responden = RespondenSKM::findOrFail($id);
        $surveiId = $responden->survei_id;
        $responden->delete();
        
        // Update statistik survei
        $this->updateSurveiStatistik($surveiId);

        return redirect()->back()->with('success', 'Berhasil menghapus responden');
    }
    
    private function updateSurveiStatistik($surveiId)
    {
        $survei = SurveiKepuasanMasyarakat::find($surveiId);
        $totalResponden = RespondenSKM::where('survei_id', $surveiId)->count();
        $nilaiSKM = RespondenSKM::where('survei_id', $surveiId)->avg('nilai_rata_rata');
        
        if ($nilaiSKM) {
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
        } else {
            $survei->update([
                'total_responden' => 0,
                'nilai_skm' => 0,
                'predikat' => null
            ]);
        }
    }
}
