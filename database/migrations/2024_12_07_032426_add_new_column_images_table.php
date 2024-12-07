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
        Schema::table('images', function (Blueprint $table) {
            $table->string('title')->after('id'); // Kolom judul
            $table->text('description')->after('title'); // Deskripsi foto
            $table->date('photo_date')->nullable()->after('description'); // Tanggal foto diambil
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('images', function (Blueprint $table) {
            $table->dropColumn(['title', 'description', 'photo_date']); // Hapus kolom saat rollback
        });
    }
};