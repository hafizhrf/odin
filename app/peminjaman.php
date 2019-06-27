<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class peminjaman extends Model
{
    //
    protected $fillable = [
        'kode','peminjam_id','tanggal_pinjam','status_peminjaman'
    ];

    protected $table = "peminjamans";
    public $timestamps = false;
}
