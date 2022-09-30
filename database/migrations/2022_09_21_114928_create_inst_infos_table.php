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
            $table->integer('eiin')->index();
            $table->integer('code')->index();
            $table->string('inst_Name')->index();
            $table->string('pass1')->index();
            $table->string('pass2')->index();
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
