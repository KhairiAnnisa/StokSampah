<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sampah_Masuk extends Model
{
    use HasFactory;

    protected $table = 'sampahmasuk';
    protected $primaryKey = 'id_sampahmasuk';

    protected $fillable = [
        'tgl_sampahmasuk',
        'total_sampahmasuk',
        'id_sampah',
        'id_sampahkotor',
    ];
    public $timestamps = false;

    public function sampah()
    {
        return $this->hasMany(Sampah::class, 'id_sampah', 'id_sampah');
    }
    public function sampah_kotor()
    {
        return $this->hasMany(Sampah_Kotor::class, 'id_sampahkotor', 'id_sampahkotor');
    }
    public function getTglSampahmasukAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('Y-m-d');
    }
}
