<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;
class artikel extends Model
{
    protected $fillable = [
        'judul', 'slug', 'foto',
        'konten', 'id_user', 'id_kategori'
    ];
    public $timestamps = true;

    public  function kategori()
    {
    return $this->belongsTo('App\kategori', 'id_kategori');
    }

    public function user()
    {
    return $this->belongsToMany('App\user', 'id_user');
    }

     public function tag()
    {
    return $this->belongsToMany('App\tag', 'artikel_tag', 'id_artikel' , 'id_tag');
    }
       public function getRouteKeyName()
    {
    return 'slug';
    }
}


