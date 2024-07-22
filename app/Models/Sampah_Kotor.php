<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Whoops\Run;

class Sampah_Kotor extends Model
{
    use HasFactory;

    protected $table = 'sampahkotor';
    protected $primaryKey = 'id_sampahkotor';
    protected $foreignKey = 'id_rute';

    protected $fillable = [
        'tgl_sampahkotor',
        'total_berat',
        'id_rute',
    ];
    public $timestamps = false;

    public function rute()
    {
        return $this->hasMany(Rute::class, $this->foreignKey, 'id_rute');
    }
    public function sampah_masuk()
    {
        return $this->belongsTo(Sampah_Masuk::class, 'id_sampahmasuk', 'id_sampahmasuk');
    }
    public function getTglSampahkotorAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('Y-m-d');
    }
}
