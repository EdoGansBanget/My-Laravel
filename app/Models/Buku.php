<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;
    Protected $table = 'buku';

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'id_buku', 'id');
    }

    // Tambahkan relasi untuk mendapatkan peminjaman terkait dengan buku
    public function getPeminjaman()
    {
        return $this->peminjaman()->get();
    }
    

    protected $fillable = [
        'gambar',
        'kode_buku',
        'judul_buku',
        'penulis',
        'penerbit',
        'kategori',
        'deskripsi',
        'tahun_terbit',

    ];
    
}