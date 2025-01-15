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
        Schema::create('puskesmas', function (Blueprint $table) {
            $table->id();
            $table->string('no');
            $table->string('nama_puskesmas');
            $table->integer('jumlah_balita_ditimbang');
            $table->integer('status_gizi_kurang');
            $table->integer('status_gizi_buruk');
            $table->integer('pemberian_vit_a');
            $table->integer('status_gizi_stunting');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('puskesmas');
    }
};
