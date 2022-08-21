<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceivingBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receiving_barangs', function (Blueprint $table) {
            $table->id();
            $table->date('tangal_receiving')->nullable();
            $table->string('no_receiving', 20)->nullable();
            $table->string('no_po', 20)->nullable();
            $table->string('no_surat_jalan', 20)->nullable();
            $table->string('nama_supplier', 50)->nullable();
            $table->decimal('total_barang_po',13,2)->nullable();
            $table->decimal('total_barang_yg_diterima',13,2)->nullable();
            $table->decimal('sisa_po',13,2)->nullable();
            $table->string('satuan', 10)->nullable();
            $table->string('validasi', 10)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('receiving_barangs');
    }
}
