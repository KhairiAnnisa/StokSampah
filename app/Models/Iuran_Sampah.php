<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Iuran_Sampah extends Model
{
    use HasFactory;

    protected $table = 'iuransampah';
    protected $primaryKey = 'id_iuransampah';
    protected $foreignKey = 'id_warga';

    protected $fillable = [
        'bulan',
        'tahun',
        'status',
        'harga',
        'id_warga',
    ];
    public $timestamps = false;

    public function warga()
    {
        return $this->hasMany(Warga::class, $this->foreignKey, 'id_warga');
    }
    public function getStatusAttribute($value)
    {
        return ucwords(str_replace('_', ' ', $value));
    }
    public function getTglIuransampahAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('Y-m-d');
    }
}
