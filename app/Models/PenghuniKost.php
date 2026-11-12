<?php

namespace App\Models;

use Database\Factories\PenghuniKostFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenghuniKost extends Model
{
    /** @use HasFactory<PenghuniKostFactory> */
    use HasFactory;

    protected $table = 'penghuni_kost';

    public $timestamps = false;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'nama',
        'nik',
        'jk',
        'telepon',
        'pekerjaan',
        'kamar',
        'tgl_masuk',
        'harga',
        'kontak_darurat',
        'status',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'tgl_masuk' => 'date:Y-m-d',
        ];
    }
}
