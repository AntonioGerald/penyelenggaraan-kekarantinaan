<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelayananKesehatan extends Model
{
    use HasFactory;

    protected $table = 'pelayanan_kesehatan';
    protected $primaryKey = 'id_pelayanan';
    public $timestamps = false;

    protected $fillable = [
        'tanggal',
        'jenis_pelayanan',
        'jumlah',
        'hari_besar',
    ];
}
