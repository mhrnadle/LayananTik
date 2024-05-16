<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aset extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'aset';

    protected $primaryKey = "aset_id";
    public $incrementing = false;
    
    protected $fillable = [
        'aset_id',
        'NamaAset',
        'JenisAset',
        'Deskripsi',
        'IDLokasi',
        'IDKategori',
        'Kondisi',
        'TanggalPembelian',
        'NilaiAset',
        'updated_by'
    ];

    public function lokasiaset(){
        return $this->hasMany(LokasiAset::class, 'id');
        }
    
    public function kategoriaset(){
        return $this->hasMany(KategoriAset::class, 'id');
        }
}
