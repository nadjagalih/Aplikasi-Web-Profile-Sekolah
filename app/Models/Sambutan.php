<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sambutan extends Model
{
    use HasFactory;
    
    protected $table = 'sambutan';
    protected $guarded = ['id'];

    // Sanitize isi_sambutan to prevent XSS while allowing safe HTML from CKEditor
    protected function setIsiSambutanAttribute($value)
    {
        $this->attributes['isi_sambutan'] = $this->sanitizeHtml($value);
    }

    private function sanitizeHtml($html)
    {
        // Allow basic HTML tags but remove script and other dangerous tags
        return strip_tags($html, '<p><br><strong><em><u><ol><ul><li><a><img><table><tr><td><th>');
    }
}
