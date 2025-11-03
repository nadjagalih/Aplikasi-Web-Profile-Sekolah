<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poliklinik;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminPoliklinikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.poliklinik.index', [
            'poliklinik' => Poliklinik::orderBy('id', 'DESC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.poliklinik.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_poliklinik' => 'required',
            'deskripsi'       => 'required',
            'gambar'          => 'nullable|mimes:jpeg,jpg,png',
        ], [
            'nama_poliklinik.required' => 'Wajib menambahkan nama poliklinik !',
            'deskripsi.required'       => 'Wajib menambahkan deskripsi !',
            'gambar.mimes'             => 'Format gambar yang di izinkan Jpeg, Jpg, Png',
        ]);

        if($validator->fails()){
            return redirect('/admin/poliklinik/create')
                ->withErrors($validator)
                ->withInput();
        }

        $gambarPath = null;
        if($request->hasFile('gambar')){
            $path       = 'img-poliklinik/';
            $file       = $request->file('gambar');
            $extension  = $file->getClientOriginalExtension();
            $fileName   = uniqid(). '.' . $extension;
            $file->storeAs($path, $fileName, 'public');
            $gambarPath = $path . $fileName;
        }

        Poliklinik::create([
            'nama_poliklinik' => $request->nama_poliklinik,
            'deskripsi'       => $request->deskripsi,
            'gambar'          => $gambarPath,
            'user_id'         => auth()->user()->id
        ]);

        return redirect('/admin/poliklinik')->with('success', 'Berhasil menambahkan data poliklinik');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $poliklinik = Poliklinik::findOrFail($id);
        return view('admin.poliklinik.edit', [
            'poliklinik' => $poliklinik,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $poliklinik = Poliklinik::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'nama_poliklinik' => 'required',
            'deskripsi'       => 'required',
        ], [
            'nama_poliklinik.required' => 'Wajib menambahkan nama poliklinik !',
            'deskripsi.required'       => 'Wajib menambahkan deskripsi !',
        ]);

        if($validator->fails()){
            return redirect("/admin/poliklinik/{$id}/edit")
                ->withErrors($validator)
                ->withInput();
        }

        $gambarPath = $poliklinik->gambar;
        if($request->hasFile('gambar')){
            if($poliklinik->gambar && file_exists(public_path('storage/'.$poliklinik->gambar))){
                unlink(public_path('storage/'.$poliklinik->gambar));
            }
            $path       = 'img-poliklinik/';
            $file       = $request->file('gambar');
            $extension  = $file->getClientOriginalExtension();
            $fileName   = uniqid(). '.' . $extension;
            $file->storeAs($path, $fileName, 'public');
            $gambarPath = $path . $fileName;
        }

        $poliklinik->update([
            'nama_poliklinik' => $request->nama_poliklinik,
            'deskripsi'       => $request->deskripsi,
            'gambar'          => $gambarPath,
            'user_id'         => auth()->user()->id
        ]);

        return redirect('/admin/poliklinik')->with('success', 'Berhasil memperbarui data poliklinik');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $poliklinik = Poliklinik::findOrFail($id);
        
        if($poliklinik->gambar && file_exists(public_path('storage/'.$poliklinik->gambar))){
            unlink(public_path('storage/'.$poliklinik->gambar));
        }
        
        $poliklinik->delete();

        return redirect('/admin/poliklinik')->with('success', 'Berhasil menghapus data poliklinik');
    }
}
