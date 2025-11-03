<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveiKepuasanMasyarakat extends Model
{
    use HasFactory;
    
    protected $table = 'survei_kepuasan_masyarakat';
    protected $guarded = ['id'];
    
    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];
}
