<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_experiences', function (Blueprint $table) {
            $table->id('work_ex_id');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('user_id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->string('work_ex_from')->nullable();
            $table->string('work_ex_to')->nullable();
            $table->string('position_title')->nullable();

            $table->string('department_agency')->nullable();
            $table->string('salary')->nullable();
            $table->string('pay_grade')->nullable();
            $table->string('status_appointment')->nullable();
            $table->tinyInteger('is_govt')->nullable();

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
        Schema::dropIfExists('work_experiences');
    }
}
