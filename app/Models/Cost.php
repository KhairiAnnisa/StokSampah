<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    use HasFactory;

    protected $table = 'cost';
    protected $primaryKey = 'id_cost';

    protected $fillable = [
        'nama_pengeluaran',
        'biaya',
        'tgl_cost',
    ];
    public $timestamps = false;

    public function getTglCostAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('Y-m-d');
    }
}
