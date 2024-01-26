<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('houses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('num_bedrooms');
            $table->integer('num_bathrooms');
            $table->integer('num_suites');
            $table->integer('num_garages');
            $table->decimal('size', 10, 2)->nullable();
            $table->decimal('value', 15, 2);
            $table->string('main_image')->nullable();
            $table->boolean('available')->default(true);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('houses');
    }
}
