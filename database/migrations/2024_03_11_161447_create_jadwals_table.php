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
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kelas');
            $table->unsignedBigInteger('id_mapel');
            $table->string('hari', 10);
            $table->smallInteger('jam_mulai');
            $table->smallInteger('jam_selesai');
            $table->timestamps();

            $table->foreign('id_kelas')->references('id')->on('kelas')->cascadeOnDelete();
            $table->foreign('id_mapel')->references('id')->on('mapels')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};
