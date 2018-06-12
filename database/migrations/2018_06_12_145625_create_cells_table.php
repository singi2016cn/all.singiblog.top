<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCellsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cells', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('at')->comment('id');
            $table->string('h',255)->comment('横ids');
            $table->string('v',255)->comment('竖ids');
            $table->unsignedInteger('h_num')->comment('横数字');
            $table->string('v_num',255)->comment('竖数字');
            $table->string('h_tip',255)->comment('横提示');
            $table->string('v_tip',255)->comment('竖提示');
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
        Schema::dropIfExists('cells');
    }
}
