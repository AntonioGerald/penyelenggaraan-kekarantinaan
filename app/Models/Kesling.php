<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kesling extends Model
{
    use HasFactory;

    protected $table = 'kesling';
    protected $primaryKey = 'id_kesling';
    public $timestamps = false;

    protected $fillable = [
        'tanggal',
        'lokasi',
        'boraks',
        'formalin',
        'air_minum',
        'suhu',
        'kelembapan',
        'pencahayaan',
        'kebisingan',
        'hari_besar',
    ];
}
