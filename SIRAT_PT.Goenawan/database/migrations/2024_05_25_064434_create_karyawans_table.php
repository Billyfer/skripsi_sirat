<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('karyawans', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->enum('role', ['Karyawan Pusat', 'Pimpinan Cabang', 'Karyawan Cabang']);
        $table->foreignId('cabang_id')->nullable()->constrained('branches')->onDelete('cascade');
        $table->string('email')->unique();
        $table->string('no_wa');
        $table->string('alamat');
        $table->string('username')->unique();
        $table->string('password');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawans');
    }
};
