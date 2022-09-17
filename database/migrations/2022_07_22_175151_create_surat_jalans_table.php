<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratJalansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_jalans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_surat_jalan');
            $table->string('nomor_surat_jalan', 50);
            $table->bigInteger('customer_id')->unsigned();
            $table->bigInteger('barang_id')->unsigned();
            $table->decimal('total_barang_kirim', 13, 2);
            $table->string('satuan', 10);
            $table->text('alamat');
            $table->string('expedisi', 20);
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
        Schema::dropIfExists('surat_jalans');
    }
}
