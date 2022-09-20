<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCenterInfos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('center_infos', function (Blueprint $table) {
            $table->id();
            $table->integer('eiin_no');
            $table->string('inst_name')->nullable();
            $table->string('thana')->nullable();
            $table->string('zilla')->nullable();
            $table->string('inst_pass', 100)->nullable();
            $table->string('inst_pass2', 100)->nullable();
            $table->boolean('is_admin')->default(0);
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('center_infos');
    }
}
