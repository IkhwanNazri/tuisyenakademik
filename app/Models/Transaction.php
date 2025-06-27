<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'daftar_id',
        'kelas',
        'jumlah',
        'bill_code',
        'status',
        'tarikh',
        'harga_kelas',
        'jumlah_bayaran',
    ];

    protected $casts = [
        'tarikh' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function daftar(): BelongsTo
    {
        return $this->belongsTo(Daftar::class);
    }
}
