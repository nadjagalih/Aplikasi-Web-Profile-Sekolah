<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalDokter extends Model
{
    use HasFactory;
    
    protected $table = 'jadwal_dokter';
    protected $guarded = ['id'];
    
    // Relasi dengan tenaga medis (dokter)
    public function dokter()
    {
        return $this->belongsTo(TenagaMedis::class, 'tenaga_medis_id');
    }
    
    // Relasi dengan poliklinik
    public function poliklinik()
    {
        return $this->belongsTo(Poliklinik::class);
    }
}
