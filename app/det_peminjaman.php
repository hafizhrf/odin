<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class det_peminjaman extends Model
{
    //
    protected $fillable = [
        'peminjaman_id', 'inventaris_id'
    ];

    protected $table = "detail_peminjamans";
    public $timestamps = false;
}
