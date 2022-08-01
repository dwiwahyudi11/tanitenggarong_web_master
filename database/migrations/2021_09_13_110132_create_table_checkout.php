<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCheckout extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkout', function (Blueprint $table) {
            $table->Increments('id_checkout');
            $table->Integer('user_id');
            $table->Integer('produk_id');
            $table->Integer('toko_id');
            $table->Integer('jml');
            $table->String('harga_c');
            $table->String('kode_checkout');
            $table->String('status_bayar');
            $table->String('tgl_checkout');
            $table->String('status_pengiriman')->nullable();
            $table->String('resi')->nullable();
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
        Schema::dropIfExists('checkout');
    }
}
