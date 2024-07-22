<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    use HasFactory;

    protected $table = 'gaji';
    protected $primaryKey = 'id_gaji';
    protected $foreignKey = 'id_karyawan';

    protected $fillable = [
        'upah',
        'tgl_gaji',
        'id_karyawan'
    ];
    public $timestamps = false;

    public function karyawan()
    {
        return $this->hasMany(Karyawan::class, $this->foreignKey, 'id_karyawan');
    }
    public function getTglGajiAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('Y-m-d');
    }
}
