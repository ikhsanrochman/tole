<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $table = 'rumah'; // Nama tabel di database

    protected $fillable = [
        'nama_rumah',
        'lokasi',
        'alamat',
        'luas_tanah',
        'luas_bangunan',
        'lantai',
        'fasilitas',
        'harga',
        'status',
        'gambar_cover',
        'gambar_detail',
    ];

    protected $casts = [
        'gambar_detail' => 'array',
    ];
}


