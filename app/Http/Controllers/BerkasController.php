<?php

namespace App\Http\Controllers;

use App\Models\Berkas;
use Illuminate\Http\Request;

class BerkasController extends Controller
{
    public function index()
    {
        $berkas = Berkas::where('status', 'Aktif')
                        ->orderBy('created_at', 'desc')
                        ->get();
        
        return view('berkas.index', compact('berkas'));
    }

    public function download($id)
    {
        $berkas = Berkas::findOrFail($id);
        
        // Increment download count
        $berkas->increment('download_count');
        
        $filePath = public_path('storage/' . $berkas->file_path);
        
        if (file_exists($filePath)) {
            return response()->download($filePath, $berkas->file_name);
        }
        
        return redirect()->back()->with('error', 'File tidak ditemukan');
    }
}
