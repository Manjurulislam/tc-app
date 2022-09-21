<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details', function (Blueprint $table) {
            $table->id();
            $table->integer('eiin');
            $table->string('college_name');
            $table->string('diatrict');
            $table->string('thana');
            $table->string('shift');
            $table->string('version');
            $table->string('group_name');
            $table->string('gender');
            $table->integer('min_gpa');
            $table->integer('own_gpa');
            $table->integer('total_seats');
            $table->integer('sq_pct');
            $table->integer('sq_num');
            $table->integer('reserve_ptc');
            $table->integer('reserve_num');
            $table->integer('sq_min_gpa');
            $table->string('college_receive');
            $table->integer('sub_reg');
            $table->integer('available_seats');
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
        Schema::dropIfExists('details');
    }
}
