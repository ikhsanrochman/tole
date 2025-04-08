<?php
// File: app/Models/Admin.php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;
    public $timestamps = false;

    protected $table = 'admin';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'whatsapp',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];
}

// File: app/Models/Rumah.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rumah extends Model
{
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
        'status',
    ];
    
    protected $casts = [
        'gambar_detail' => 'array',
    ];
}