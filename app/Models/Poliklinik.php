<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poliklinik extends Model
{
    use HasFactory;
    
    protected $table = 'poliklinik';
    protected $guarded = ['id'];
    
    // Relasi dengan tenaga medis
    public function tenagaMedis()
    {
        return $this->hasMany(TenagaMedis::class);
    }
    
    // Relasi dengan jadwal dokter
    public function jadwalDokter()
    {
        return $this->hasMany(JadwalDokter::class);
    }
}
