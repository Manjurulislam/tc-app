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
            $table->integer('eiin_no')->nullable();
            $table->string('college_name')->nullable();
            $table->string('group', 100)->nullable();
            $table->string('class')->nullable();
            $table->integer('roll_no')->unique()->nullable();
            $table->string('session', 50)->nullable();
            $table->string('district')->nullable();
            $table->string('upazila')->nullable();
            $table->string('post_office')->nullable();
            $table->text('subject_comp')->nullable();
            $table->integer('subject_elec')->nullable();
            $table->integer('subject_optn')->nullable();
            $table->integer('ssc_roll_no');
            $table->integer('ssc_reg_no');
            $table->string('ssc_pass_year', 50);
            $table->double('ssc_cgpa', 8, 2);
            $table->string('ssc_bord', 100);
            $table->string('attachment')->nullable();
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
