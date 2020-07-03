<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pd_general');
            $table->unsignedBigInteger('pd_classification');
            $table->unsignedBigInteger('pd_header');
            $table->unsignedBigInteger('pd_list')->nullable();
            $table->unsignedBigInteger('dpd_list')->nullable();
            $table->unsignedBigInteger('pd_brand')->nullable();
            
            $table->string('filepath')->nullable();
            $table->string('filename')->nullable();
            $table->string('filetype')->nullable();
            $table->string('filesize')->nullable();
            $table->string('filedate')->nullable();

            $table->timestamps();

            $table->foreign('pd_general')->references('id')->on('generals')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('pd_classification')->references('id')->on('classifications')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('pd_header')->references('id')->on('headers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('pd_list')->references('id')->on('pd_lists')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('dpd_list')->references('id')->on('dpd_lists')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('pd_brand')->references('id')->on('brands')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
