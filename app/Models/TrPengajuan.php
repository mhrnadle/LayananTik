<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrPengajuan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tr_pengajuan';

    protected $guarded = ['pengajuan_id'];
    protected $primaryKey = 'pengajuan_id';

    protected $fillable = [
        'skl_id',
        'users_id',
        'pengajuan_detail',
        'pengajuan_status',
        'pengajuan_catatan',
        'created_by',
        'updated_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function layanan()
    {
        return $this->belongsTo(KategoriLayanan::class, 'skl_id', 'id');
    }
}
