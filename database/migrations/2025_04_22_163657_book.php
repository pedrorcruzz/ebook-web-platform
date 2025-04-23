<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('book', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['available', 'checked_out'])->default('available');
            $table->unsignedBigInteger('user_author_id');
            $table->string('title', 255);
            $table->string('genre', 100);
            $table->string('isbn', 13)->unique();
            $table->float('price');
            $table->integer('pages')->nullable();
            $table->date('publication_date');
            $table->text('description')->nullable();
            $table->string('cover_image')->nullable();
            $table->timestamps();

            $table->foreign('user_author_id')->references('id')->on('user_author')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('book');
    }
};
