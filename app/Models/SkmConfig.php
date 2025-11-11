<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkmConfig extends Model
{
    use HasFactory;
    
    protected $table = 'skm_config';
    
    protected $fillable = [
        'nama_puskesmas',
        'api_url',
        'kode_organisasi',
        'status',
        'keterangan',
        'login_url'
    ];
}
