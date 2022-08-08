<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoPurchasingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('po_purchasings', function (Blueprint $table) {
            $table->id();
            $table->string('no_po', 50);
            $table->bigInteger('supplier_id')->unsigned();
            $table->date('tanggal_po');
            $table->date('tanggal_kirim_awal');
            $table->date('tanggal_kirim_akhir');
            $table->decimal('total_barang');
            $table->string('satuan', 10);
            $table->string('validasi', 5);
            $table->timestamps();

            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('po_purchasings');
    }
}
