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
        Schema::create('warehouses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('address');
            $table->string('telp');
            $table->double('capacity')->default(0);
            $table->double('storage')->default(0);
            $table->string('image');
            $table->foreignId('type_id')->constrained()->cascadeOnDelete();
            $table->foreignId('indonesia_provinces_id')->constrained()->cascadeOnDelete();
            $table->foreignId('indonesia_cities_id')->constrained()->cascadeOnDelete();
            $table->foreignId('indonesia_districts_id')->constrained()->cascadeOnDelete();
            $table->foreignId('indonesia_villages_id')->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('warehouses');
    }
};
