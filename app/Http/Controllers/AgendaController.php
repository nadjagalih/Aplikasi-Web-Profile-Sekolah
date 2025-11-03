<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function index()
    {
        return view('agenda.index');
    }
    
    public function getEvents()
    {
        $agendas = Agenda::where('status', 'Aktif')
            ->get()
            ->map(function($agenda) {
                return [
                    'id' => $agenda->id,
                    'title' => $agenda->judul,
                    'start' => $agenda->tanggal_mulai->format('Y-m-d H:i:s'),
                    'end' => $agenda->tanggal_selesai ? $agenda->tanggal_selesai->format('Y-m-d H:i:s') : null,
                    'color' => $agenda->warna,
                    'description' => $agenda->deskripsi,
                    'location' => $agenda->tempat,
                ];
            });
            
        return response()->json($agendas);
    }
}
