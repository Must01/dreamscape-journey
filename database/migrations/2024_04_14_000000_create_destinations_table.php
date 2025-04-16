<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->string('destination_name');
            $table->string('location');
            $table->text('description');
            $table->json('photos')->nullable();
            $table->integer('tour_duration');
            $table->integer('max_travelers');
            $table->decimal('price', 10, 2);
            $table->boolean('is_featured')->default(false); // Add this line
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('destinations');
    }
};
