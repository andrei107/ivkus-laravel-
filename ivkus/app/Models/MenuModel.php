<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuModel extends Model
{
   protected $table = 'menu';
   public $timestamps = false;
   protected $fillable = [
        'menu_id',
        'name_ru',
        'name_en'
   ];

   public static function getItemByMenuId($menu_id)
   {
        return self::query()
                ->where('menu_id', $menu_id)
                ->first();
   }
}
