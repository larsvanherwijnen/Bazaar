<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('rentals', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Use UUIDs for the primary key
            $table->foreignUuid('user_id')->references('id')->on('users');
            $table->foreignUuid('advert_id')->references('id')->on('adverts');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};
