<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;


class Motor extends Model
{
    //
    use HasFactory;
    use SoftDeletes; // 2. Aktifkan fitur SoftDeletes di model ini

    protected $guarded = [];
}
