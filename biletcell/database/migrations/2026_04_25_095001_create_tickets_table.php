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
    Schema::create('tickets', function (Blueprint $table) {
        $table->id();
        // İlişkiler: Bir bilet bir kullanıcıya ve bir etkinliğe aittir.
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('event_id')->constrained()->onDelete('cascade');

        // Koltuk Bilgisi
        $table->string('seat_number'); // Örn: A1, 42 vb.

        // Fiyat ve Durum (Opsiyonel ama profesyonel durur)
        $table->decimal('price', 8, 2);
        $table->string('status')->default('confirmed'); // Ödeme sonrası onaylı bilet

        $table->timestamps();
        $table->string('transaction_id')->nullable();

        // KRİTİK: Bir etkinlikte aynı koltuk numarasından sadece bir tane olabilir.
        $table->unique(['event_id', 'seat_number']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
