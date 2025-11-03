<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RespondenSKM extends Model
{
    use HasFactory;
    
    protected $table = 'responden_skm';
    protected $guarded = ['id'];
    
    // Relasi dengan survei
    public function survei()
    {
        return $this->belongsTo(SurveiKepuasanMasyarakat::class, 'survei_id');
    }
    
    // Relasi dengan jenis kelamin
    public function jenisKelamin()
    {
        return $this->belongsTo(JenisKelamin::class);
    }
    
    // Relasi dengan pekerjaan
    public function pekerjaan()
    {
        return $this->belongsTo(Pekerjaan::class);
    }
}
