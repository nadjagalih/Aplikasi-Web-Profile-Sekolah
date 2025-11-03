<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class LayananKesehatan extends Model
{
    use HasFactory;
    use Sluggable;

    protected $table = 'layanan_kesehatan';
    protected $guarded = ['id'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama_layanan'
            ]
        ];
    }
}
