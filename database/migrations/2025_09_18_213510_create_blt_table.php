<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blts', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 16)->unique();
            $table->string('kk', 16);
            $table->string('nama');
            $table->text('alamat');
            $table->year('tahun');
            // Status: Pending, Disetujui, Ditolak, atau Cair
            $table->enum('status', ['pending', 'disetujui', 'ditolak', 'cair'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blts');
    }
};
