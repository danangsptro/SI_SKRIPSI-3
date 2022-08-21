<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMpicBarangMasuksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mpic_barang_masuks', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal')->nullable();
            $table->string('no_surat_jalan', 30)->nullable();
            $table->bigInteger('supplier_id')->unsigned();
            $table->bigInteger('barang_id')->unsigned();
            $table->string('satuan', 10)->nullable();
            $table->decimal('total_barang_masuk', 13, 2)->nullable();
            $table->timestamps();

            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
            $table->foreign('barang_id')->references('id')->on('barangs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mpic_barang_masuks');
    }
}
