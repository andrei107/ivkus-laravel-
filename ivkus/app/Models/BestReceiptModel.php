<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BestReceiptModel extends Model
{
   protected $table = 'best_receipt';
   public $timestamps = false;
   protected $fillable = [
        'name_ru',
        'name_en',
        'img_path',
        'link',
        'time',
        'activity'
   ];
}
