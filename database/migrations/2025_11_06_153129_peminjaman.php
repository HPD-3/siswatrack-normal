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
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->string('peminjaman_id');
            $table->string('role');
            $table->unsignedBigInteger('barang_id');
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali');
            $table->text('keterangan');
            $table->string('added_by');
            $table->string(column: 'status')->default(value: false);
            $table->timestamps();

            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
