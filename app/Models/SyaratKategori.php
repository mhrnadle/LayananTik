<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SyaratKategori extends Model
{
    use HasFactory;

    protected $table = 'syarat_kategori';

    protected $guarded = ['syarat_id'];
    protected $primaryKey = 'syarat_id';
    public $incrementing = false;

    protected $fillable = [
        'syarat_label',
        'syarat_kategori_id',
        'syarat_type',
        'syarat_type_file',
        'syarat_status',
        'syarat_template',
        'created_by',
        'updated_by'
    ];
}
