<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pegawai extends Model
{
    protected $primaryKey = 'nip';

    protected $fillable = ['id_jabatan','id_pendidikan','nama','alamat','jenis_kelamin','notelp','status'];

    public function jabatan(){
        return $this->belongsTo(jabatan::class, 'id_jabatan');
    }

    public function Riwayatpendidikan(){
        return $this->belongsTo(Riwayatpendidikan::class, 'id_pendidikan');
    }

}
