<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LayananKesehatan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminLayananKesehatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.layanan-kesehatan.index', [
            'layanan' => LayananKesehatan::orderBy('id', 'DESC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.layanan-kesehatan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_layanan' => 'required',
            'deskripsi'    => 'required',
            'gambar'       => 'nullable|mimes:jpeg,jpg,png',
        ], [
            'nama_layanan.required' => 'Wajib menambahkan nama layanan !',
            'deskripsi.required'    => 'Wajib menambahkan deskripsi !',
            'gambar.mimes'          => 'Format gambar yang di izinkan Jpeg, Jpg, Png',
        ]);

        if($validator->fails()){
            return redirect('/admin/layanan-kesehatan/create')
                ->withErrors($validator)
                ->withInput();
        }

        $gambarPath = null;
        if($request->hasFile('gambar')){
            $path       = 'img-layanan/';
            $file       = $request->file('gambar');
            $extension  = $file->getClientOriginalExtension();
            $fileName   = uniqid(). '.' . $extension;
            $file->storeAs($path, $fileName, 'public');
            $gambarPath = $path . $fileName;
        }

        LayananKesehatan::create([
            'nama_layanan' => $request->nama_layanan,
            'deskripsi'    => $request->deskripsi,
            'gambar'       => $gambarPath,
            'biaya'        => $request->biaya,
            'persyaratan'  => $request->persyaratan,
            'status'       => $request->status ?? 'Tersedia',
            'user_id'      => auth()->user()->id
        ]);

        return redirect('/admin/layanan-kesehatan')->with('success', 'Berhasil menambahkan layanan kesehatan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $layanan = LayananKesehatan::findOrFail($id);
        return view('admin.layanan-kesehatan.edit', [
            'layanan' => $layanan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $layanan = LayananKesehatan::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'nama_layanan' => 'required',
            'deskripsi'    => 'required',
        ], [
            'nama_layanan.required' => 'Wajib menambahkan nama layanan !',
            'deskripsi.required'    => 'Wajib menambahkan deskripsi !',
        ]);

        if($validator->fails()){
            return redirect("/admin/layanan-kesehatan/{$id}/edit")
                ->withErrors($validator)
                ->withInput();
        }

        $gambarPath = $layanan->gambar;
        if($request->hasFile('gambar')){
            if($layanan->gambar && file_exists(public_path('storage/'.$layanan->gambar))){
                unlink(public_path('storage/'.$layanan->gambar));
            }
            $path       = 'img-layanan/';
            $file       = $request->file('gambar');
            $extension  = $file->getClientOriginalExtension();
            $fileName   = uniqid(). '.' . $extension;
            $file->storeAs($path, $fileName, 'public');
            $gambarPath = $path . $fileName;
        }

        $layanan->update([
            'nama_layanan' => $request->nama_layanan,
            'deskripsi'    => $request->deskripsi,
            'gambar'       => $gambarPath,
            'biaya'        => $request->biaya,
            'persyaratan'  => $request->persyaratan,
            'status'       => $request->status ?? 'Tersedia',
            'user_id'      => auth()->user()->id
        ]);

        return redirect('/admin/layanan-kesehatan')->with('success', 'Berhasil memperbarui layanan kesehatan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $layanan = LayananKesehatan::findOrFail($id);
        
        if($layanan->gambar && file_exists(public_path('storage/'.$layanan->gambar))){
            unlink(public_path('storage/'.$layanan->gambar));
        }
        
        $layanan->delete();

        return redirect('/admin/layanan-kesehatan')->with('success', 'Berhasil menghapus layanan kesehatan');
    }
}
