<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sambutan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AdminSambutanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.sambutan.index', [
            'sambutan' => Sambutan::orderBy('id', 'DESC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sambutan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jabatan' => 'required',
            'nama' => 'required',
            'isi_sambutan' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ], [
            'jabatan.required' => 'Wajib mengisi jabatan!',
            'nama.required' => 'Wajib mengisi nama!',
            'isi_sambutan.required' => 'Wajib mengisi isi sambutan!',
            'foto.image' => 'File harus berupa gambar!',
            'foto.mimes' => 'Format gambar yang diizinkan: Jpeg, Jpg, Png',
            'foto.max' => 'Ukuran gambar maksimal 2MB!'
        ]);

        if($validator->fails()){
            return redirect('/admin/sambutan/create')
                ->withErrors($validator)
                ->withInput();
        }

        $fotoPath = null;
        if($request->hasFile('foto')){
            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            
            // Simpan langsung ke public/storage/sambutan
            $file->move(public_path('storage/sambutan'), $fileName);
            $fotoPath = 'sambutan/' . $fileName;
        }

        Sambutan::create([
            'jabatan' => $request->jabatan,
            'nama' => $request->nama,
            'isi_sambutan' => $request->isi_sambutan,
            'foto' => $fotoPath,
            'tempat' => $request->tempat,
            'tanggal' => $request->tanggal,
            'status' => $request->status ?? 'Aktif',
            'user_id' => Auth::id()
        ]);

        return redirect('/admin/sambutan')->with('success', 'Berhasil menambahkan sambutan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $sambutan = Sambutan::findOrFail($id);
        return view('admin.sambutan.edit', [
            'sambutan' => $sambutan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $sambutan = Sambutan::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'jabatan' => 'required',
            'nama' => 'required',
            'isi_sambutan' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ], [
            'jabatan.required' => 'Wajib mengisi jabatan!',
            'nama.required' => 'Wajib mengisi nama!',
            'isi_sambutan.required' => 'Wajib mengisi isi sambutan!',
            'foto.image' => 'File harus berupa gambar!',
            'foto.mimes' => 'Format gambar yang diizinkan: Jpeg, Jpg, Png',
            'foto.max' => 'Ukuran gambar maksimal 2MB!'
        ]);

        if($validator->fails()){
            return redirect("/admin/sambutan/{$id}/edit")
                ->withErrors($validator)
                ->withInput();
        }

        $fotoPath = $sambutan->foto;
        if($request->hasFile('foto')){
            // Delete old foto if exists
            if($sambutan->foto && file_exists(public_path('storage/' . $sambutan->foto))){
                unlink(public_path('storage/' . $sambutan->foto));
            }
            
            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            
            // Simpan langsung ke public/storage/sambutan
            $file->move(public_path('storage/sambutan'), $fileName);
            $fotoPath = 'sambutan/' . $fileName;
        }

        $sambutan->update([
            'jabatan' => $request->jabatan,
            'nama' => $request->nama,
            'isi_sambutan' => $request->isi_sambutan,
            'foto' => $fotoPath,
            'tempat' => $request->tempat,
            'tanggal' => $request->tanggal,
            'status' => $request->status ?? 'Aktif',
            'user_id' => Auth::id()
        ]);

        return redirect('/admin/sambutan')->with('success', 'Berhasil memperbarui sambutan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $sambutan = Sambutan::findOrFail($id);
        
        // Delete foto if exists
        if($sambutan->foto && file_exists(public_path('storage/' . $sambutan->foto))){
            unlink(public_path('storage/' . $sambutan->foto));
        }
        
        $sambutan->delete();

        return redirect('/admin/sambutan')->with('success', 'Berhasil menghapus sambutan');
    }
}
