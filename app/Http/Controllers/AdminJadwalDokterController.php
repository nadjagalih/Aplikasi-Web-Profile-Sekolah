<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalDokter;
use App\Models\TenagaMedis;
use App\Models\Poliklinik;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AdminJadwalDokterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.jadwal-dokter.index', [
            'jadwal' => JadwalDokter::with('dokter', 'poliklinik')->orderBy('hari')->orderBy('jam_mulai')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.jadwal-dokter.create', [
            'dokter' => TenagaMedis::where('jenis', 'Dokter')->where('status', 'Aktif')->get(),
            'poliklinik' => Poliklinik::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tenaga_medis_id' => 'required',
            'poliklinik_id'   => 'required',
            'hari'            => 'required',
            'jam_mulai'       => 'required',
            'jam_selesai'     => 'required',
        ], [
            'tenaga_medis_id.required' => 'Wajib memilih dokter !',
            'poliklinik_id.required'   => 'Wajib memilih poliklinik !',
            'hari.required'            => 'Wajib memilih hari !',
            'jam_mulai.required'       => 'Wajib mengisi jam mulai !',
            'jam_selesai.required'     => 'Wajib mengisi jam selesai !',
        ]);

        if($validator->fails()){
            return redirect('/admin/jadwal-dokter/create')
                ->withErrors($validator)
                ->withInput();
        }

        JadwalDokter::create([
            'tenaga_medis_id' => $request->tenaga_medis_id,
            'poliklinik_id'   => $request->poliklinik_id,
            'hari'            => $request->hari,
            'jam_mulai'       => $request->jam_mulai,
            'jam_selesai'     => $request->jam_selesai,
            'kuota'           => $request->kuota ?? 20,
            'keterangan'      => $request->keterangan,
            'status'          => $request->status ?? 'Aktif',
            'user_id'         => auth()->user()->id
        ]);

        return redirect('/admin/jadwal-dokter')->with('success', 'Berhasil menambahkan jadwal dokter');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $jadwal = JadwalDokter::findOrFail($id);
        return view('admin.jadwal-dokter.edit', [
            'jadwal'     => $jadwal,
            'dokter'     => TenagaMedis::where('jenis', 'Dokter')->where('status', 'Aktif')->get(),
            'poliklinik' => Poliklinik::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $jadwal = JadwalDokter::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'tenaga_medis_id' => 'required',
            'poliklinik_id'   => 'required',
            'hari'            => 'required',
            'jam_mulai'       => 'required',
            'jam_selesai'     => 'required',
        ], [
            'tenaga_medis_id.required' => 'Wajib memilih dokter !',
            'poliklinik_id.required'   => 'Wajib memilih poliklinik !',
            'hari.required'            => 'Wajib memilih hari !',
            'jam_mulai.required'       => 'Wajib mengisi jam mulai !',
            'jam_selesai.required'     => 'Wajib mengisi jam selesai !',
        ]);

        if($validator->fails()){
            return redirect("/admin/jadwal-dokter/{$id}/edit")
                ->withErrors($validator)
                ->withInput();
        }

        $jadwal->update([
            'tenaga_medis_id' => $request->tenaga_medis_id,
            'poliklinik_id'   => $request->poliklinik_id,
            'hari'            => $request->hari,
            'jam_mulai'       => $request->jam_mulai,
            'jam_selesai'     => $request->jam_selesai,
            'kuota'           => $request->kuota ?? 20,
            'keterangan'      => $request->keterangan,
            'status'          => $request->status ?? 'Aktif',
            'user_id'         => auth()->user()->id
        ]);

        return redirect('/admin/jadwal-dokter')->with('success', 'Berhasil memperbarui jadwal dokter');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $jadwal = JadwalDokter::findOrFail($id);
        $jadwal->delete();

        return redirect('/admin/jadwal-dokter')->with('success', 'Berhasil menghapus jadwal dokter');
    }
}
