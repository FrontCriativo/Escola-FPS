<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->string('author');
            $table->string('isbn')->nullable()->unique();
            $table->string('publisher')->nullable();
            $table->integer('publication_year')->nullable();
            $table->unsignedSmallInteger('pages')->nullable();
            $table->text('description')->nullable();
            $table->string('cover_path')->nullable();
            $table->string('accent_color', 20)->default('#5B6183');
            $table->string('shelf_location')->nullable();
            $table->enum('status', ['available', 'reserved', 'maintenance'])->default('available');
            $table->unsignedInteger('copies_total')->default(1);
            $table->unsignedInteger('copies_available')->default(1);
            $table->boolean('is_featured')->default(false);
            $table->timestamps();

            $table->index(['title', 'author']);
            $table->index(['status', 'is_featured']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
