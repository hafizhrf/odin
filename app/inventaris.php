<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class inventaris extends Model
{
    //
    protected $fillable = [
        'jenis_id', 'ruang_id', 'admin_id', 'nama', 'kode','kondisi', 'keterangan','tanggal_register','image'
    ];

    protected $table = "inventariss";
}
