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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('number');
            $table->string('address')->nullable();
            $table->integer('pinCode')->nullable();
            $table->string('bankName')->nullable();
            $table->string('accountName')->nullable();
            $table->integer('accountNumber')->nullable();
            $table->integer('ifscCode')->nullable();
            $table->string('branch')->nullable();
            $table->integer('gstNumber')->nullable();
            $table->integer('phonePeNumber')->nullable();
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
        Schema::dropIfExists('vendors');
    }
};
