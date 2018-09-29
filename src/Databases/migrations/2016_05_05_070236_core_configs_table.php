<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CoreConfigsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('core_configs', function (Blueprint $table) {
            $table->string('key')->comment('配置名称')->unique();
            $table->text('value')->comment('配置值')->nullable();
            $table->text('package')->comment('扩展包名称')->nullable();
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
        Schema::dropIfExists('core_configs');
    }
}
