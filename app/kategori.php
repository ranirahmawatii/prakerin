<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;
class kategori extends Model
{
     protected $fillable = ['nama_kategori', 'slug'];
   public $timestamps = true;

   public function Artikel()
   {
       return $this->hasMany('App\artikel', 'id_kategori');
   }
 public function getRoutekeyName()
   {
      return'slug';
   }

    public static function boot()
   {
      parent::boot();
      self::deleting(function ($kategori) {

        if ($kategori->artikel->count() >0) {
            $html = 'kategori tidak bisa di hapus karena masih di gunakan oleh artikel ';
            $html = '<ul>';
            foreach ($kategori->artikel as $data) {
                $html = "<li>$data->jdul</li>";
            }
            $html = '<ul>';
            Session::flash("flash_notification", [
                "level" => "danger",
                "message"=> $html
            ]);
            return false;
        }
      });
   }
}