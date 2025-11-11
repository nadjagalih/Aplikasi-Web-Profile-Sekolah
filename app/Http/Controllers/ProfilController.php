<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfilController extends Controller
{
    public function index()
    {
        $profil = Profil::first();
        return view('profil.index', [
            'profil'   => $profil
        ]);
    }
}
