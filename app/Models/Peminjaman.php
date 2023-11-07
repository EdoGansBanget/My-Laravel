<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'id_buku', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    Protected $table = 'peminjaman';

    protected $fillable = [
        'tanggal_pinjam',
        'tanggal_kembali',
        'id_buku',
        'id_user',
        'status',
    ];
}