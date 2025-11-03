<?php

namespace App\Http\Controllers;

use App\Models\LayananKesehatan;
use Illuminate\Http\Request;

class LayananKesehatanController extends Controller
{
    public function index()
    {
        return view('layanan-kesehatan.index', [
            'layanan' => LayananKesehatan::where('status', 'Tersedia')->orderBy('id', 'DESC')->paginate(9)
        ]);
    }

    public function detail($slug)
    {
        $layanan = LayananKesehatan::where('slug', $slug)->firstOrFail();
        return view('layanan-kesehatan.detail', [
            'layanan' => $layanan
        ]);
    }
}
