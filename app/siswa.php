<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class siswa extends Model
{
    protected $tabel = 'siswas' ;
    protected $filable = ['nama'];
}
