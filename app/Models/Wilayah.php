<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Wilayah extends Model
{
    protected $connection = 'supabase';
    protected $table = 'wilayah';
    public $timestamps = false;
    protected $guarded = ['id'];

    public function rw(): BelongsTo
    {
        return $this->belongsTo(WilayahRw::class, 'rw_id');
    }

    public function rumah(): HasMany
    {
        return $this->hasMany(Rumah::class, 'wilayah_id');
    }
}
