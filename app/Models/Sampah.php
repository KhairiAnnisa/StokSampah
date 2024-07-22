<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sampah extends Model
{
    use HasFactory;

    protected $table = 'sampah';
    protected $primaryKey = 'id_sampah';

    protected $fillable = [
        'nama_sampah',
        'stok_sampah',
        'kategori',
    ];

    public $timestamps = false;

    public function sampah_masuk()
    {
        return $this->belongsTo(Sampah_Masuk::class, 'id_sampahmasuk', 'id_sampahmasuk');
    }

    public function sampah_keluar()
    {
        return $this->belongsTo(Sampah_Keluar::class, 'id_sampahkeluar');
    }
}
