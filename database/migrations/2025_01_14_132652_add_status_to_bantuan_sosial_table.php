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
    Schema::table('bantuan_sosial', function (Blueprint $table) {
        $table->string('status')->default('Menunggu')->after('catatan_tambahan');
    });
}

public function down()
{
    Schema::table('bantuan_sosial', function (Blueprint $table) {
        $table->dropColumn('status');
    });
}

};
