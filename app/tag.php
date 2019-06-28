<?php

namespace App;
use Session;
use Illuminate\Database\Eloquent\Model;

class tag extends Model
{
    protected $fillable = ['nama', 'slug'];
    public $timestamps = true;

    public function Artikel()
    {
        return $this->belongsToMany('App\artikel', 'artikel_tag', 'id_tag' , 'id_artikel');
    }

//     public static function boot()
//    {
//       parent::boot();
//       self::deleting(function ($tag) {

//         if ($tag->artikel->count() > 0 ) {
//             $html = 'tag tidak bisa di hapus karena masih di gunakan oleh artikel ';
//             $html .= '<ul>';
//             foreach ($tag->artikel as $data) {
//                 $html .= "<li>$data->judul</li>";
//             }
//             $html = '<ul>';
//             Session::flash("flash_notification", [
//                 "level" => "danger",
//                 "message"=> $html
//             ]);

//             return false;
//         }
//       });
   }

