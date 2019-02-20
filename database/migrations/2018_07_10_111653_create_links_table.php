<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasswordResetsTable extends Migration
{
    /**
     * 建立數據表.
     *
     * @return void
     */
    public function up()
    {       
            Schema::create('links', function (Blueprint $table) {
                // 更改數據表的引擎
            $table->engine='MyISAM';
            $table->increments('link_id');
            $table->string('link_name')->default('')->comment('//友情鏈接名稱');
            $table->string('link_title')->default('')->comment('//友情鏈接標題');
            $table->string('link_url')->default('')->comment('//友情鏈接連接');
            $table->integer('link_order')->default(0)->comment('//友情鏈接排序');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('links');
    }
}
