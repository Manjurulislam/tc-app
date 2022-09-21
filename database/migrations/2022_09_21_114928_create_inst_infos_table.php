<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inst_infos', function (Blueprint $table) {
            $table->id();
            $table->integer('eiin');
            $table->integer('code');
            $table->string('inst_Name');
            $table->string('pass1');
            $table->string('pass2');
            $table->integer('is_confirm');
            $table->integer('student_count');
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
        Schema::dropIfExists('inst_infos');
    }
}
