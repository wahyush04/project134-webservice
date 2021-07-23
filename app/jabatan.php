<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class jabatan extends Model
{
    protected $primaryKey = 'id_jabatan';

    protected $fillable = ['jabatan','bagian','ruangan','gaji'];
}
