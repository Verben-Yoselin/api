
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date_time');
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->foreignId('vendor_id')->constrained('users')->onDelete('cascade');
            $table->bigInteger('total')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};