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
            $table->unsignedBigInteger('user_id');
            $table->string('title', 100);
            $table->string('author', 50);
            $table->string('isbn')->unique();
            $table->text('plot')->nullable();
            $table->unsignedSmallInteger('total_readings')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropForeign('books_user_id_foreign');
            $table->dropColumn('user_id');
        });

        Schema::dropIfExists('books');
    }
};
