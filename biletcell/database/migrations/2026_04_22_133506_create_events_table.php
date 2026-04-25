<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
    $table->id();

    $table->string('title');
    $table->text('description');

    $table->string('category'); // şimdilik enum gibi kullanacağız

    $table->dateTime('event_date');

    // Migration içinde
    $table->string('status')->default('upcoming');

    $table->decimal('price', 8, 2);

    $table->string('image_path')->nullable();

    // FOREIGN KEYS
    $table->foreignId('venue_id')->constrained()->onDelete('cascade');
    $table->foreignId('user_id')->constrained()->onDelete('cascade');

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
