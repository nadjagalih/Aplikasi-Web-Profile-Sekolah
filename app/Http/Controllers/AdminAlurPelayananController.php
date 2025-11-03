<?php

namespace App\Http\Controllers;

use App\Models\AlurPelayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminAlurPelayananController extends Controller
{
    public function index()
    {
        $alurPelayanans = AlurPelayanan::orderBy('urutan', 'asc')->get();
        return view('admin.alur-pelayanan.index', compact('alurPelayanans'));
    }

    public function create()
    {
        return view('admin.alur-pelayanan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'urutan' => 'required|integer|min:0',
            'deskripsi' => 'required|string',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'status' => 'required|in:Aktif,Non-Aktif',
        ]);

        if ($request->hasFile('icon')) {
            $validated['icon'] = $request->file('icon')->store('alur-pelayanan', 'public');
        }

        AlurPelayanan::create($validated);

        return redirect()->route('alur-pelayanan.index')->with('success', 'Alur pelayanan berhasil ditambahkan!');
    }

    public function edit(AlurPelayanan $alurPelayanan)
    {
        return view('admin.alur-pelayanan.edit', compact('alurPelayanan'));
    }

    public function update(Request $request, AlurPelayanan $alurPelayanan)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'urutan' => 'required|integer|min:0',
            'deskripsi' => 'required|string',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'status' => 'required|in:Aktif,Non-Aktif',
        ]);

        if ($request->hasFile('icon')) {
            // Hapus icon lama
            if ($alurPelayanan->icon) {
                Storage::disk('public')->delete($alurPelayanan->icon);
            }
            $validated['icon'] = $request->file('icon')->store('alur-pelayanan', 'public');
        }

        $alurPelayanan->update($validated);

        return redirect()->route('alur-pelayanan.index')->with('success', 'Alur pelayanan berhasil diperbarui!');
    }

    public function destroy(AlurPelayanan $alurPelayanan)
    {
        // Hapus icon jika ada
        if ($alurPelayanan->icon) {
            Storage::disk('public')->delete($alurPelayanan->icon);
        }

        $alurPelayanan->delete();

        return redirect()->route('alur-pelayanan.index')->with('success', 'Alur pelayanan berhasil dihapus!');
    }
}
