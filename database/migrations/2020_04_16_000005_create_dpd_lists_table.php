<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDPdListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dpd_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pd_lists_id');
            $table->string('dpd_list')->unique();
            $table->timestamps();

            $table->foreign('pd_lists_id')->references('id')->on('pd_lists')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dpd_lists');
    }
}
