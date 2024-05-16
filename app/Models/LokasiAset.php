<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiAset extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'lokasiaset';

    protected $primaryKey = "Lokasi_id";
    public $incrementing = false;
    
    protected $fillable = [
        'Lokasi_id',
        'NamaLokasi',
        'Deskripsi',
        'Kunker',
        'updated_by'
    ];

    public function aset()
    {
        return $this->hasMany(Aset::class, 'IDKategori');
    }
}
