<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sampah_Keluar extends Model
{
    use HasFactory;

    protected $table = 'sampahkeluar';
    protected $primaryKey = 'id_sampahkeluar';
    protected $foreignKey = 'id_sampah';


    protected $fillable = [
        'tgl_sampahkeluar',
        'harga_sampahkeluar',
        'berat_sampahkeluar',
        'total_sampahkeluar',
        'jenis',
        'id_sampah',
    ];
    public $timestamps = false;

    public function sampah()
    {
        return $this->hasMany(Sampah::class, 'id_sampah', 'id_sampah');
    }

    public function setTotalSampahkeluarAttribute($value)
    {
        $this->attributes['total_sampahkeluar'] = $this->harga_sampahkeluar * $this->berat_sampahkeluar;
    }

    public function getJenisAttribute($value)
    {
        return ucwords(str_replace('_', ' ', $value));
    }

    public function getTglSampahkeluarAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('Y-m-d');
    }
}
