
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 128);
            $table->text('description')->nullable();
            $table->string('url_picture', 200)->nullable();
            $table->foreignId('category_id')->constrained('category_products')->onDelete('restrict');
            $table->bigInteger('stock')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};