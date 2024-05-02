<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KategoriLayanan extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'kategori_layanan';

    protected $primaryKey = "kl_id";
    public $incrementing = false;
    
    protected $fillable = [
        'kunker',
        'kl_label',
        'kl_status',
        'updated_by'
    ];

    public function sublayanan()
    {
        return $this->hasMany(KategoriSublayanan::class);
    }
}
