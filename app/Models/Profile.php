<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    Protected $table = 'profile';

    protected $fillable = [
        'nama',
        'prodi_lulusan',
        'gelar',
        'tahun_lulus',
        'foto',
    ];
}