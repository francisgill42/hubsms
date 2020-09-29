<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->boolean('isApproved')->default(0);
            $table->string('grades_offered');
            $table->string('school_name');
            $table->string('school_logo');
            $table->string('school_branch')->nullable();
            $table->string('education_type');
            $table->string('center_number')->nullable();
            $table->string('phone');
            $table->string('website')->nullable();
            $table->string('address');
            $table->string('area');
            $table->string('town');
            $table->string('province');
            $table->string('country');
            $table->integer('user_id');
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
        Schema::dropIfExists('schools');
    }
}
