<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangSelesaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_selesais', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_masuk_barang')->nullable();
            $table->string('nama_customer', 50)->nullable();
            $table->string('nama_barang', 50)->nullable();
            $table->decimal('total_barang', 13, 2)->nullable();
            $table->string('satuan', 10)->nullable();
            $table->string('no_label', 20)->nullable();
            $table->string('status', 15)->nullable();
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
        Schema::dropIfExists('barang_selesais');
    }
}
