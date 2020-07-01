<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePdListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pd_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pd_header_id');
            $table->string('pd_list')->unique();
            $table->timestamps();

            $table->foreign('pd_header_id')->references('id')->on('headers')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pd_lists');
    }
}
