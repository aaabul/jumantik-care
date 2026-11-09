<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pemeriksaan extends Model
{
    protected $connection = 'supabase';
    protected $table = 'pemeriksaan';
    public $timestamps = false;
    protected $guarded = ['id'];

    protected function casts(): array
    {
        return ['tanggal_pemeriksaan' => 'date'];
    }

    public function rumah(): BelongsTo
    {
        return $this->belongsTo(Rumah::class, 'rumah_id');
    }

    public function petugas(): BelongsTo
    {
        return $this->belongsTo(Profile::class, 'petugas_id');
    }

    public function tindakLanjut(): HasOne
    {
        return $this->hasOne(TindakLanjut::class, 'pemeriksaan_id');
    }
}
