<?php

namespace App\Http\Controllers;

use App\Models\Sambutan;
use Illuminate\Http\Request;

class SambutanController extends Controller
{
    public function index()
    {
        $sambutan = Sambutan::where('status', 'Aktif')->first();
        return view('sambutan.index', [
            'sambutan' => $sambutan
        ]);
    }
}
