<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlatAngkut extends Model
{
    use HasFactory;

    protected $table = 'alat_angkut';
    protected $primaryKey = 'id_alat_angkut';
    public $timestamps = false;

    protected $fillable = [
        'tanggal',
        'lokasi',
        'jenis',
        'alat',
        'jumlah',
        'hari_besar',
    ];
}
