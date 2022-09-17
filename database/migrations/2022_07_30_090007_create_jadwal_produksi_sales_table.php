<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalProduksiSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_produksi_sales', function (Blueprint $table) {
            $table->id();
            $table->date('jadwal_dibuat');
            $table->bigInteger('customer_id')->unsigned();
            $table->bigInteger('barang_id')->unsigned();
            $table->decimal('total_barang', 13, 2);
            $table->string('satuan', 10);
            $table->date('tanggal_produksi');
            $table->date('deadline_produksi');
            $table->string('status_produksi',15);
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
        Schema::dropIfExists('jadwal_produksi_sales');
    }
}
