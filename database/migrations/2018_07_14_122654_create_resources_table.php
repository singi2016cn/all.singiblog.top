<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',255)->comment('名称');
            $table->unsignedTinyInteger('type')->comment('类型');
            $table->string('download_link',255)->comment('下载链接');
            $table->string('download_password',255)->comment('下载密码')->nullable();
            $table->unsignedInteger('download_count')->comment('下载次数')->default(0);
            $table->unsignedInteger('is_free')->comment('1免费2收费')->default(1);
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
        Schema::dropIfExists('resources');
    }
}
