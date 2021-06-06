<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTestsSheetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_tests_sheet', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_test_id');
            $table->unsignedBigInteger('question_id');
            $table->string('answer_option')->nullable();
            $table->boolean('is_correct');
            $table->integer('time_taken')->comment('seconds');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_test_id')->on('user_tests')->references('id');
            $table->foreign('question_id')->on('questions')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_tests_sheet');
    }
}
