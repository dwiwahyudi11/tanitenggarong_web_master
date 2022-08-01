<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableBiodata extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biodata', function (Blueprint $table) {
            $table->Increments('id_biodata');
            $table->Integer('user_id');
            $table->String('nama_lengkap')->nullable();
            $table->String('tmp_lahir')->nullable();
            $table->String('tgl_lahir')->nullable();
            $table->String('jenis_kelamin')->nullable();
            $table->String('alamat')->nullable();
            $table->String('no_telp')->nullable();
            $table->String('foto')->nullable();
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
        Schema::dropIfExists('biodata');
    }
}
