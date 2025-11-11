<?php

namespace App\Http\Controllers;

use App\Models\StrukturOrganisasi;
use Illuminate\Http\Request;

class StrukturOrganisasiController extends Controller
{
    public function index()
    {
        $strukturOrganisasi = StrukturOrganisasi::all();
        return view('struktur-organisasi.index', [
            'strukturOrganisasi' => $strukturOrganisasi
        ]);
    }
}
