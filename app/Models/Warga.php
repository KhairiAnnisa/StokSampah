<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    use HasFactory;

    protected $table = 'warga';
    protected $primaryKey = 'id_warga';

    protected $fillable = [
        'nama_warga',
        'no_hp_warga',
        'blok',
        'alamat',
        'kelurahan',
        'kecamatan',
        'rt',
        'rw'
    ];
    public $timestamps = false;

    public function iuran_sampah()
    {
        return $this->belongsTo(Iuran_Sampah::class, 'id_warga');
    }
}
