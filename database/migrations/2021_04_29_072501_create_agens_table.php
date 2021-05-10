<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agens', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_user');
            $table->bigInteger('id_sales');
            $table->string('name');
            $table->char('id_provinsi')->nullable();
            $table->char('id_kabupaten')->nullable();
            $table->char('id_kecamatan')->nullable();
            $table->char('id_kelurahan')->nullable();
            $table->integer('poin')->nullable();
            $table->string('kode_outlet');
            $table->string('ggsp_type');
            $table->string('jenis_toko');
            $table->string('pic_outlet');
            $table->string('nomor_hp');
            $table->text('nama_jalan');
            $table->string('foto_path_sales')->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agens');
    }
}
