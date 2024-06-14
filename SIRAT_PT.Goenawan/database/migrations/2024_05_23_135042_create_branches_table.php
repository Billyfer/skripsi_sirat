<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchesTable extends Migration
{
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('nama_cabang');
            $table->string('kota_kabupaten');
            $table->string('alamat');
            $table->string('nama_pimpinan');
            $table->string('nib_cabang');
            $table->string('pdf_nib');
            $table->string('pdf_akta_cabang');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('branches');
    }
}
