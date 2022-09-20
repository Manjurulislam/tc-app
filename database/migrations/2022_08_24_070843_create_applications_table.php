<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('app_no')->unique();
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
            $table->string('sonali_sheba_no')->unique();
            $table->string('sonali_sheba_branch')->nullable();
            $table->dateTime('payment_date')->nullable();
            $table->boolean('payment_status')->default(0);
            $table->dateTime('app_date')->nullable();
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
        Schema::dropIfExists('applications');
    }
}
