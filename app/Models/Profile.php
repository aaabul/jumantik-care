<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Profile extends Authenticatable
{
    protected $connection = 'supabase';
    protected $table = 'profiles';
    protected $primaryKey = 'id';

    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $guarded = [];

    public function getNameAttribute(): string
    {
        return (string) ($this->attributes['nama_lengkap'] ?? 'Pengguna Jumantik');
    }

    public function getAuthPasswordName(): string
    {
        return 'id';
    }

    public function wilayah(): BelongsTo
    {
        return $this->belongsTo(Wilayah::class, 'wilayah_id');
    }

    public function rw(): BelongsTo
    {
        return $this->belongsTo(WilayahRw::class, 'rw_id');
    }

    public function pemeriksaan(): HasMany
    {
        return $this->hasMany(Pemeriksaan::class, 'petugas_id');
    }
}
