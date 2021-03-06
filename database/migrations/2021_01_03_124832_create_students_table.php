<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');

            $table->date('birthday');
            $table->string('where_birthday');
            $table->boolean('kind');
            $table->string('address');

            $table->string('father_name')->nullable();
            $table->bigInteger('father_phone')->nullable();
            $table->bigInteger('father_nin')->nullable();
            $table->boolean('father_type')->nullable();

            $table->string('mother_first_name')->nullable();
            $table->string('mother_last_name')->nullable();
            $table->bigInteger('mother_phone')->nullable();
            $table->bigInteger('mother_nin')->nullable();
            $table->boolean('mother_type')->nullable();


            $table->unsignedBigInteger('country_id')->index();
            $table->unsignedBigInteger('classe_id')->index();

            $table->timestamps();

            $table->foreign('classe_id')->references('id')->on('classes')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
