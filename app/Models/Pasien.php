<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;
    
    protected $table = 'pasien';
    protected $guarded = ['id'];
    
    // Relasi dengan jenis kelamin
    public function jenisKelamin()
    {
        return $this->belongsTo(JenisKelamin::class);
    }
    
    // Relasi dengan agama
    public function agama()
    {
        return $this->belongsTo(Agama::class);
    }
    
    // Relasi dengan pekerjaan
    public function pekerjaan()
    {
        return $this->belongsTo(Pekerjaan::class);
    }
}
