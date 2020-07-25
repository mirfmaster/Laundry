<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaundriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laundries', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pelanggan');
            $table->string('telp')->nullable();
            $table->integer('berat')->nullable();
            $table->boolean('flagSatuan')->default(0);
            $table->integer('satuan')->nullable();
            $table->integer('pembayaran')->default(0);
            $table->integer('total');
            $table->boolean('flagSelesai')->default(0);
            $table->boolean('flagDiambil')->default(0);
            $table->string('pengambil')->nullable();
            $table->unsignedBigInteger('layanan_id');
            $table->foreign('layanan_id')->references('id')->on('layanans');
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
        Schema::dropIfExists('laundries');
    }
}
