<?php

namespace App\Http\Controllers;

use App\Models\Berkas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminBerkasController extends Controller
{
    public function index()
    {
        $berkas = Berkas::orderBy('created_at', 'desc')->get();
        return view('admin.berkas.index', compact('berkas'));
    }

    public function create()
    {
        return view('admin.berkas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori' => 'nullable|string|max:100',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar|max:10240',
            'status' => 'required|in:Aktif,Non-Aktif'
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('berkas', $fileName, 'public');
            $fileSize = $this->formatFileSize($file->getSize());

            Berkas::create([
                'judul' => $validated['judul'],
                'deskripsi' => $validated['deskripsi'],
                'kategori' => $validated['kategori'],
                'file_path' => $filePath,
                'file_name' => $fileName,
                'file_size' => $fileSize,
                'status' => $validated['status']
            ]);
        }

        return redirect()->route('berkas.index')->with('success', 'Berkas berhasil ditambahkan');
    }

    public function edit($id)
    {
        $berkas = Berkas::findOrFail($id);
        return view('admin.berkas.edit', compact('berkas'));
    }

    public function update(Request $request, $id)
    {
        $berkas = Berkas::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori' => 'nullable|string|max:100',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar|max:10240',
            'status' => 'required|in:Aktif,Non-Aktif'
        ]);

        if ($request->hasFile('file')) {
            // Delete old file
            if ($berkas->file_path && Storage::disk('public')->exists($berkas->file_path)) {
                Storage::disk('public')->delete($berkas->file_path);
            }

            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('berkas', $fileName, 'public');
            $fileSize = $this->formatFileSize($file->getSize());

            $validated['file_path'] = $filePath;
            $validated['file_name'] = $fileName;
            $validated['file_size'] = $fileSize;
        }

        $berkas->update($validated);

        return redirect()->route('berkas.index')->with('success', 'Berkas berhasil diupdate');
    }

    public function destroy($id)
    {
        $berkas = Berkas::findOrFail($id);

        // Delete file
        if ($berkas->file_path && Storage::disk('public')->exists($berkas->file_path)) {
            Storage::disk('public')->delete($berkas->file_path);
        }

        $berkas->delete();

        return redirect()->route('berkas.index')->with('success', 'Berkas berhasil dihapus');
    }

    private function formatFileSize($bytes)
    {
        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        } else {
            return $bytes . ' bytes';
        }
    }
}
