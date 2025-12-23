<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vektor extends Model
{
    use HasFactory;

    protected $table = 'vektor';
    protected $primaryKey = 'id_vektor';
    public $timestamps = false;

    protected $fillable = [
        'tanggal',
        'lokasi',
        'lalat',
        'kecoa',
        'jentik_dbd',
        'hari_besar',
    ];
}
