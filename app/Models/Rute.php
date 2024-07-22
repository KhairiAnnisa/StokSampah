<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rute extends Model
{
    use HasFactory;

    protected $table = 'rute';
    protected $primaryKey = 'id_rute';

    protected $fillable = [
        'nama_rute',
        'detail_rute',
    ];
    public $timestamps = false;

    public function sampah_kotor()
    {
        return $this->belongsTo(Sampah_Kotor::class, 'id_sampahkotor', 'id_sampahkotor');
    }
}
