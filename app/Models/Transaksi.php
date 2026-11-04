<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Transaksi extends Model
{

    // Buka gembok izin simpan data
    protected $guarded = [];

    // Memberi tahu Laravel bahwa 1 Transaksi ini adalah milik 1 Motor
    public function motor()
    {
        return $this->belongsTo(Motor::class);
    }
}
