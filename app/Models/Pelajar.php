<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pelajar extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'kelas',
        'darjah',
        'daftar_id',
    ];

    public function daftar(): BelongsTo
    {
        return $this->belongsTo(Daftar::class);
    }
} 