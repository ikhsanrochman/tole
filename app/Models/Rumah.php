<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rumah extends Model
{
    use HasFactory;

    protected $table = 'rumah';
    protected $fillable = [
        'nama_rumah', 
        'lokasi', 
        'alamat', 
        'luas_tanah', 
        'luas_bangunan', 
        'lantai', 
        'fasilitas', 
        'gambar_cover', 
        'gambar_detail', 
        'harga', 
        'status'
    ];
    protected $casts = [
        'gambar_detail' => 'array',
    ];
    

    public function getGambarDetailArrayAttribute()
    {
        return json_decode($this->gambar_detail, true);
    }

    public function getFormattedHargaAttribute()
    {
        return 'Rp ' . number_format((float)$this->harga, 0, ',', '.');
    }
}