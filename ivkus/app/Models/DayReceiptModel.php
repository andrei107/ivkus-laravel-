<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DayReceiptModel extends Model
{
   protected $table = 'day_receipt';
   public $timestamps = false;
   protected $fillable = [
        'name_ru',
        'name_en',
        'img_path',
        'link',
        'activity'
   ];
}
