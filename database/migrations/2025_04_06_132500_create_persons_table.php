
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('persons', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('pat_surname', 50)->nullable();
            $table->string('mat_surname', 50)->nullable();
            $table->string('fullname', 152)->nullable();
            $table->bigInteger('ci')->unique();
            $table->date('birthdate')->nullable();
            $table->bigInteger('phone_number')->nullable();
            $table->text('direction')->nullable();
            $table->text('coordinates')->nullable();
            $table->string('url_picture', 200)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('persons');
    }
};