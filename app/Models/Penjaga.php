<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjaga extends Model
{
    protected $table = 'profil_penjaga';
    public $timestamps = false;

    protected $fillable = ['nama', 'alamat', 'no_telepon', 'tugas', 'area'];
}
