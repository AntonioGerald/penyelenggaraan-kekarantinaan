<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyakit extends Model
{
    use HasFactory;

    protected $table = 'penyakit';
    protected $primaryKey = 'id_penyakit';
    public $timestamps = false;

    protected $fillable = [
        'tanggal',
        'kategori',
        'nama_penyakit',
        'jumlah',
        'hari_besar',
    ];
}
