<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Riwayatpendidikan extends Model
{
    protected $primaryKey = 'id_pendidikan';

    protected $fillable = ['jenjang','jurusan','tahun','keterangan'];
}
