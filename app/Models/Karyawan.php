<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawan';
    protected $primaryKey = 'id_karyawan';

    protected $fillable = [
        'nama_karyawan',
        'alamat',
        'posisi',
        'no_hp',
    ];
    public $timestamps = false;

    public function gaji()
    {
        return $this->belongsTo(Gaji::class, 'id_karyawan');
    }
}
