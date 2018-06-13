<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrosswordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crosswords', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('is_h')->comment('1横0竖');
            $table->string('seq',15)->comment('横竖序号');
            $table->string('word',255)->commit('标题');
            $table->string('tip',255)->commit('描述');
            $table->string('cell_ids',255)->commit('方块ids');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crosswords');
    }
}
