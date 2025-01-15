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
    Schema::create('bantuan_sosial', function (Blueprint $table) {
        $table->id();
        $table->string('nama_program');
        $table->integer('jumlah_penerima_bantuan');
        $table->string('wilayah_provinsi');
        $table->string('wilayah_kabupaten');
        $table->string('wilayah_kecamatan');
        $table->date('tanggal_penyaluran');
        $table->string('bukti_penyaluran');
        $table->text('catatan_tambahan')->nullable();
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
        Schema::dropIfExists('bantuan_sosials');
    }
};
