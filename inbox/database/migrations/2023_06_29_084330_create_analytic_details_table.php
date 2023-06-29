<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analytic_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('analytic_log_id');
            $table->unsignedBigInteger('order_id');
            $table->double('final_score');
            $table->integer('rank');
            $table->timestamps();

            $table->foreign('analytic_log_id')->references('id')->on('analytic_logs')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('analytic_details');
    }
};
