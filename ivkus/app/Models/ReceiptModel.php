<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReceiptModel extends Model
{
   protected $table = 'receipts';
   public $timestamps = false;
   protected $fillable = [
        'name_ru',
        'name_en',
        'img',
        'time',
        'activity',
        'calories',
        'ingridients_ru',
        'ingridients_en',
        'receipt_ru',
        'receipt_en',
        'best',
        'day',
        'fast',
        'for_menu',
        'persons'
   ];

   public static function getReceiptByTypeBlock($block)
   {
        return self::query()
                ->where($block, '=', 1)
                ->where('activity', 1)
                ->get();
   }

   public static function getReceiptById($id)
   {
          return self::query()
               ->whereId($id)
               ->first();
   }

   public static function getReceiptsByMenuId($menuId, $id)
   {
     return self::query()
               ->where('for_menu', $menuId)
               ->where('id', '!=', $id)
               ->limit(3)
               ->get();
   }

   public static function findByUserWord($word)
   {
     return self::query()
               ->where('name_ru', 'LIKE', $word)
               ->get();
   }

   public static function getReceiptByMenu($menu_id)
   {
     return self::query()
          ->where('for_menu', $menu_id)
          ->get();
   }
}
