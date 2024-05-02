<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KategoriSublayanan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kategori_sublayanan';

    protected $primaryKey = "skl_id";
    public $incrementing = false;

    protected $fillable = [
        'kl_id',
        'skl_label',
        'skl_status',
        'created_by',
        'updated_by'
    ];

    public function layanan()
    {
        return $this->belongsTo(KategoriLayanan::class);
    }
}
