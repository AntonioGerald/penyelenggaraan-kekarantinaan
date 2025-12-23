<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penumpang extends Model
{
    use HasFactory;

    protected $table = 'penumpang';
    protected $primaryKey = 'id_penumpang';
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
