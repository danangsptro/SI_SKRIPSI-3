<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spks', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_spk')->nullable();
            $table->string('no_spk', 20)->nullable();
            $table->string('nama_customer',50)->nullable();
            $table->string('nama_barang',50)->nullable();
            $table->decimal('total_barang')->nullable();
            $table->string('satuan',15)->nullable();
            $table->date('tanggal_kirim')->nullable();
            $table->date('tanggal_akhir')->nullable();
            $table->string('status_spk',10)->nullable();
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
        Schema::dropIfExists('spks');
    }
}
