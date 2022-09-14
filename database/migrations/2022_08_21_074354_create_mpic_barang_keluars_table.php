<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMpicBarangKeluarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mpic_barang_keluars', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_masuk');
            $table->date('tanggal_keluar')->nullable();
            $table->string('no_surat_jalan',30)->nullable();
            $table->string('nama_supplier',50)->nullable();
            $table->string('nama_barang',50)->nullable();
            $table->string('satuan',10)->nullable();
            $table->decimal('stock_barang1',13,2)->nullable();
            $table->decimal('total_barang_keluar', 13,2)->nullable();
            $table->decimal('stock_barang2',13,2)->nullable();
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
        Schema::dropIfExists('mpic_barang_keluars');
    }
}
