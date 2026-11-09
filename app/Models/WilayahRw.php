<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WilayahRw extends Model
{
    protected $connection = 'supabase';
    protected $table = 'wilayah_rw';
    public $timestamps = false;
    protected $guarded = ['id'];

    public function wilayah(): HasMany
    {
        return $this->hasMany(Wilayah::class, 'rw_id');
    }
}
