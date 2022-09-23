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
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('detail_id')->nullable();
            $table->integer('eiin_no');
            $table->string('college_code', 50);
            $table->string('college_name');
            $table->string('post_office');
            $table->string('upazila');
            $table->string('district');
            $table->string('sonali_sheba_no')->unique()->nullable();
            $table->string('sonali_sheba_branch')->nullable();
            $table->dateTime('payment_date')->nullable();
            $table->boolean('payment_status')->default(0);
            $table->boolean('status')->default(1);
            $table->dateTime('applied_at')->nullable();
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
