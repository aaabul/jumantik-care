<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rumah extends Model
{
    protected $connection = 'supabase';
    protected $table = 'rumah';
    public $timestamps = false;
    protected $guarded = ['id'];

    protected function casts(): array
    {
        return ['status_aktif' => 'boolean'];
    }

    public function wilayah(): BelongsTo
    {
        return $this->belongsTo(Wilayah::class, 'wilayah_id');
    }

    public function pemeriksaan(): HasMany
    {
        return $this->hasMany(Pemeriksaan::class, 'rumah_id');
    }
}
