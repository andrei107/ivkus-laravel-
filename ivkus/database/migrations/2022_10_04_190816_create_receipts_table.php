<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->integer('id');
            $table->string('name_ru', 50);
            $table->string('name_en', 50);
            $table->string('img');
            $table->integer('time');
            $table->boolean('activity');
            $table->integer('calories');
            $table->string('ingridients_ru', 300);
            $table->string('ingridients_en', 300);
            $table->string('receipt_ru');
            $table->string('receipt_en');
            $table->boolean('best');
            $table->boolean('day');
            $table->boolean('fast');
            $table->integer('for_menu');
            $table->integer('persons');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('receipts');
    }
}
