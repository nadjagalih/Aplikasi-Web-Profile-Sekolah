<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;
    
    protected $table = 'layanan_kesehatan';
    protected $guarded = ['id'];

    // Sanitize deskripsi and persyaratan to prevent XSS
    protected function setDeskripsiAttribute($value)
    {
        $this->attributes['deskripsi'] = $this->sanitizeHtml($value);
    }

    protected function setPersyaratanAttribute($value)
    {
        $this->attributes['persyaratan'] = $this->sanitizeHtml($value);
    }

    private function sanitizeHtml($html)
    {
        // Allow basic HTML tags but remove script and other dangerous tags
        return strip_tags($html, '<p><br><strong><em><u><ol><ul><li><a><img><table><tr><td><th>');
    }
}