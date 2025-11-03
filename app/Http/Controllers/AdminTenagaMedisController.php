<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TenagaMedis;
use App\Models\Poliklinik;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminTenagaMedisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.tenaga-medis.index', [
            'tenagaMedis' => TenagaMedis::with('poliklinik')->orderBy('id', 'DESC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tenaga-medis.create', [
            'poliklinik' => Poliklinik::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'      => 'required',
            'nip'       => 'required|unique:tenaga_medis',
            'jenis'     => 'required',
            'foto'      => 'required|mimes:jpeg,jpg,png',
        ], [
            'nama.required'     => 'Wajib menambahkan nama tenaga medis !',
            'nip.required'      => 'Wajib menambahkan NIP !',
            'nip.unique'        => 'NIP sudah terdaftar !',
            'jenis.required'    => 'Wajib memilih jenis tenaga medis !',
            'foto.required'     => 'Wajib menambahkan foto !',
            'foto.mimes'        => 'Format gambar yang di izinkan Jpeg, Jpg, Png',
        ]);

        if($request->hasFile('foto')){
            $path       = 'img-tenaga-medis/';
            $file       = $request->file('foto');
            $extension  = $file->getClientOriginalExtension();
            $fileName   = uniqid(). '.' . $extension;
            $foto       = $file->storeAs($path, $fileName, 'public');
        } else {
            $foto       = null;
        }

        if($validator->fails()){
            return redirect('/admin/tenaga-medis/create')
                ->withErrors($validator)
                ->withInput();
        }

        $tenagaMedis = TenagaMedis::create([
            'nama'              => $request->nama,
            'nip'               => $request->nip,
            'jenis'             => $request->jenis,
            'spesialisasi'      => $request->spesialisasi,
            'poliklinik_id'     => $request->poliklinik_id,
            'pendidikan'        => $request->pendidikan,
            'alamat'            => $request->alamat,
            'telepon'           => $request->telepon,
            'email'             => $request->email,
            'foto'              => $path . $fileName,
            'status'            => $request->status ?? 'Aktif',
            'user_id'           => auth()->user()->id
        ]);

        return redirect('/admin/tenaga-medis')->with('success', 'Berhasil menambahkan data tenaga medis');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tenagaMedis = TenagaMedis::findOrFail($id);
        return view('admin.tenaga-medis.edit', [
            'tenagaMedis'   => $tenagaMedis,
            'poliklinik'    => Poliklinik::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $tenagaMedis = TenagaMedis::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'nama'      => 'required',
            'nip'       => 'required|unique:tenaga_medis,nip,'.$id,
            'jenis'     => 'required',
        ], [
            'nama.required'     => 'Wajib menambahkan nama tenaga medis !',
            'nip.required'      => 'Wajib menambahkan NIP !',
            'nip.unique'        => 'NIP sudah terdaftar !',
            'jenis.required'    => 'Wajib memilih jenis tenaga medis !',
        ]);

        if($request->hasFile('foto')){
            if($tenagaMedis->foto && file_exists(public_path('storage/'.$tenagaMedis->foto))){
                unlink(public_path('storage/'.$tenagaMedis->foto));
            }
            $path       = 'img-tenaga-medis/';
            $file       = $request->file('foto');
            $extension  = $file->getClientOriginalExtension(); 
            $fileName   = uniqid() . '.' . $extension; 
            $foto       = $file->storeAs($path, $fileName, 'public');
            $fotoPath   = $path . $fileName;
        } else {
            $fotoPath = $tenagaMedis->foto;
        }

        if ($validator->fails()) {
            return redirect("/admin/tenaga-medis/{$id}/edit")
                ->withErrors($validator)
                ->withInput();
        }

        $tenagaMedis->update([
            'nama'              => $request->nama,
            'nip'               => $request->nip,
            'jenis'             => $request->jenis,
            'spesialisasi'      => $request->spesialisasi,
            'poliklinik_id'     => $request->poliklinik_id,
            'pendidikan'        => $request->pendidikan,
            'alamat'            => $request->alamat,
            'telepon'           => $request->telepon,
            'email'             => $request->email,
            'foto'              => $fotoPath,
            'status'            => $request->status ?? 'Aktif',
            'user_id'           => auth()->user()->id
        ]);

        return redirect('/admin/tenaga-medis')->with('success', 'Berhasil memperbarui data tenaga medis');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tenagaMedis = TenagaMedis::findOrFail($id);
        
        if($tenagaMedis->foto && file_exists(public_path('storage/'.$tenagaMedis->foto))){
            unlink(public_path('storage/'.$tenagaMedis->foto));
        }
        
        $tenagaMedis->delete();

        return redirect('/admin/tenaga-medis')->with('success', 'Berhasil menghapus data tenaga medis');
    }
}
