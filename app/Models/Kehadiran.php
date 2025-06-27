<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kehadiran extends Model
{
    protected $fillable = ['pelajar_id','tarikh','masa','nama_pelajar','nama'];
    public function pelajar() :BelongsTo
    {
        return $this->belongsTo(Pelajar::class , 'pelajar_id');
    }
}
