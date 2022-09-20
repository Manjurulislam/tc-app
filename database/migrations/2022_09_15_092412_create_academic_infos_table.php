<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademicInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->integer('eiin_no');
            $table->string('college_code', 50);
            $table->string('college_name');
            $table->string('department');
            $table->string('class');
            $table->integer('roll_no')->unique();
            $table->string('session', 100);
            $table->string('district');
            $table->string('upazila');
            $table->string('post_office');
            $table->text('subjects')->nullable();
            $table->integer('ssc_roll_no');
            $table->integer('ssc_reg_no');
            $table->string('ssc_passing_year', 100);
            $table->integer('ssc_cgpa');
            $table->string('ssc_bord', 100);
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
        Schema::dropIfExists('academic_infos');
    }
}
