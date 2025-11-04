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
            $table->string('isbn', 150);
            $table->string('title', 150);
            $table->foreignId('author_id')->constrained('authors')->onDelete('cascade');
            $table->string('genre', 150);
            $table->date('published_date');
            $table->unsignedInteger('copies')->default(1);
            $table->enum('status', ['available', 'borrowed', 'reserved', 'n/a'])->default('available');
            $table->string('pdf_link')->nullable();
            $table->integer('total_borrow_count');
            $table->timestamps();
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
