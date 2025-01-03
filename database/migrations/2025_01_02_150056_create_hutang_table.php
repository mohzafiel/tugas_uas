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
    Schema::create('hutang', function (Blueprint $table) {
        $table->id();
        $table->string('nama_lengkap');
        $table->date('tanggal');
        $table->decimal('nominal', 15, 2);
        $table->enum('status', ['Lunas', 'Belum Lunas']);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('hutang');
    }

};