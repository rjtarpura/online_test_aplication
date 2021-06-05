<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_tests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->timestamp('start_at');
            $table->timestamp('end_at')->nullable();
            $table->integer('total_correct_questions')->nullable();
            $table->integer('total_incorrect_questions')->nullable();
            $table->boolean('is_passed')->nullable();
            $table->boolean('is_auto_stop')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->on('users')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_tests');
    }
}
