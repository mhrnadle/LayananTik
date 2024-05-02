<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrBerkas extends Model
{
    use HasFactory;

    protected $table = 'tr_berkas';

    protected $guarded = ['berkas_id'];

    protected $fillable = [
        'pengajuan_id',
        'syarat_id',
        'id_reference',
        'klasifikasi',
        'berkas_file',
        'berkas_status',
        'berkas_catatan',
        'created_by',
        'updated_by',
    ];
}
