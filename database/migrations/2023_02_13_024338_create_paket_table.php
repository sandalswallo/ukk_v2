<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paket', function (Blueprint $table) {
            $table->id();
            // $table->enum('jenis_paket', ['kiloan', 'satuan']);
            // $table->enum('benda', ['pakaian', 'selimut', 'bed_cover', 'karpet']);
            // $table->enum('nama_paket', ['cuci_basah', 'cuci_kering', 'cuci_strika']);
            // $table->enum('layanan', ['reguler', 'flash']);
            $table->string('benda_id');
            $table->string('jenis_paket_id');
            $table->string('layanan_id');
            $table->string('berat_id');
            $table->integer('harga');
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
        Schema::dropIfExists('paket');
    }
};
