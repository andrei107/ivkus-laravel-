<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdviceModel extends Model
{
   protected $table = 'articles';
   public $timestamps = false;
   protected $fillable = [
        'name_ru',
        'name_en',
        'short_ru',
        'short_en',
        'img',
        'full_description_ru',
        'full_description_en',
   ];

   public static function getAdviceById($id)
   {
          return self::query()
               ->whereId($id)
               ->get();
   }

}
