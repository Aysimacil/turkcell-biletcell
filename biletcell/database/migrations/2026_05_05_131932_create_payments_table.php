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
    Schema::create('payments', function (Blueprint $table) {
        $table->id();

        // Kimin ödediği
        $table->foreignId('user_id')->constrained()->onDelete('cascade');

        // Hangi etkinlik için
        $table->foreignId('event_id')->constrained()->onDelete('cascade');

        // Ödeme bilgileri
        $table->decimal('amount', 8, 2);       // Toplam tutar (örn: 250.00)
        $table->string('card_number');          // Sadece son 4 hanesi saklayacağız
        $table->string('transaction_id')->unique(); // Benzersiz işlem numarası
        $table->string('status');               // 'success' veya 'failed'

        // Hangi koltuklar satın alındı (virgülle ayrılmış: "A1,A2,A3")
        $table->string('seat_numbers');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
