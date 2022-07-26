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
            $table->date('tanggal_masuk_barang');
            $table->bigInteger('customer_id')->unsigned();
            $table->bigInteger('barang_id')->unsigned();
            $table->integer('total_barang');
            $table->string('satuan');
            $table->string('no_label');
            $table->string('status');
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
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
        Schema::dropIfExists('barang_selesais');
    }
}