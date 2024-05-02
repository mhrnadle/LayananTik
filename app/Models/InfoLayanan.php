<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoLayanan extends Model
{
    use HasFactory, Sluggable, SluggableScopeHelpers;

    protected $table = 'info_layanan';

    protected $primaryKey = "layanan_id";
    public $incrementing = false;

    protected $fillable = [
        'kunker_pj',
        'layanan_nama',
        'layanan_slug',
        'layanan_desc',
        'layanan_apk',
        'layanan_status',
        'layanan_sop',
        'created_by',
        'updated_by'
    ];

    public function sluggable(): array
    {
        return [
            'layanan_slug' => [
                'source' => 'layanan_slug'
            ]
        ];
    }
}
