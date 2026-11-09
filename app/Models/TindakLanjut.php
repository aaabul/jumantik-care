<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TindakLanjut extends Model
{
    protected $connection = 'supabase';
    protected $table = 'tindak_lanjut';
    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'tanggal_tindak_lanjut' => 'date',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function pemeriksaan(): BelongsTo
    {
        return $this->belongsTo(Pemeriksaan::class, 'pemeriksaan_id');
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(Profile::class, 'updated_by');
    }
}
