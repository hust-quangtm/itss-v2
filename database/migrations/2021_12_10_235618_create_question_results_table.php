<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_result', function (Blueprint $table) {
            $table->unsignedBigInteger('result_id');
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('option_id');
            $table->unsignedBigInteger('points');
            $table->foreign('result_id')->references('id')->on('results')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('questions')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('option_id')->references('id')->on('options')
                ->onUpdate('cascade')->onDelete('cascade');
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
        Schema::table('question_result', function (Blueprint $table) {
            $table->dropForeign(['result_id', 'question_id', 'option_id']);
        });

        Schema::dropIfExists('question_result');
    }
}
