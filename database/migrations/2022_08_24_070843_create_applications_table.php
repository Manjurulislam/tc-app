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
            $table->unsignedBigInteger('student_id')->index();
            $table->integer('from_college_eiin')->index();
            $table->integer('to_college_eiin')->index();
            $table->string('college_code', 50);
            $table->string('college_name')->index();
            $table->string('post_office');
            $table->string('upazila');
            $table->string('district');
            $table->string('sonali_sheba_no')->unique()->nullable();
            $table->boolean('payment_status')->default(0);
            $table->boolean('status')->default(1);
            $table->dateTime('applied_at');
            $table->dateTime('payment_date')->nullable();
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
