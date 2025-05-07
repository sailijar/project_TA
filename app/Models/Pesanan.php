<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'pelanggan_id',
        'barang_id',
        'jumlah',
    ];

    public function pelanggan(): BelongsTo
    {
        return $this->belongsTo(pelanggan::class);
    }

    public function barang(): BelongsTo
    {
        return $this->belongsTo(barang::class);
    }


}
