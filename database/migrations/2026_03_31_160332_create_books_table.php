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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title')->index(); // Title is often used to search books
            $table->string('publisher');
            $table->string('author')->index(); // Same for author
            $table->string('genre')->index(); // Genre is often used for filtering
            $table->date('book_publication');
            $table->integer('word_count')->default(0);
            $table->decimal('price_usd', 8, 2)->default(0.00);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
