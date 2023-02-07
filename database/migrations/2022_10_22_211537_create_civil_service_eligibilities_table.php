<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCivilServiceEligibilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('civil_service_eligibilities', function (Blueprint $table) {
            $table->id('cse_id');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('user_id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->string('career_exam')->nullable();
            $table->string('rating')->nullable();
            $table->string('date_exam')->nullable();
            $table->string('place_exam')->nullable();
            $table->string('license_no')->nullable();
            $table->string('license_validity')->nullable();

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
        Schema::dropIfExists('civil_service_eligibilities');
    }
}
