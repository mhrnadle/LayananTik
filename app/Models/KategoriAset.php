<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriAset extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'kategoriaset';

    protected $primaryKey = "kategori_id";
    public $incrementing = false;
    
    protected $fillable = [
        'kategori_id',
        'NamaKategori',
        'updated_by'
    ];

    public function aset()
    {
        return $this->hasMany(Aset::class, 'IDKategori');
    }
}
