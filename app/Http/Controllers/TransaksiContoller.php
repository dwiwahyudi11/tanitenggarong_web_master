<?php

namespace App\Http\Controllers;
use APP\Transaksi;

use Illuminate\Http\Request;

class TransaksiContoller extends Controller
{
    // public function index(){
    //     $transaksiPading['listPanding'] = Transaksi::whereStatus("MENUNGGU")->get();

    //     $transaksiSelesai['listDone'] = Transaksi::where("Status", "NOT LIKE", "%MENUNGGU%")->get();

    //     return view('transaksi')->with($transaksiPading)->with($transaksiSelesai);
    // }

    // public function batal($id){
    //     $transaksi = Transaksi::with(['details.produk', 'user'])->where('id', $id)->first();
    //     $this->pushNotif('Transaksi Diproses', "Transasi produk ".$transaksi->details[0]->produk->name." sedang diproses", $transaksi->user->fcm);
    //     $transaksi->update([
    //         'status' => "BATAL"
    //     ]);
    //     return redirect('transaksi');
    // }

    // public function confirm($id){
    //     $transaksi = Transaksi::with(['details.produk', 'user'])->where('id', $id)->first();
    //     $this->pushNotif('Transaksi Diproses', "Transasi produk ".$transaksi->details[0]->produk->name." sedang diproses", $transaksi->user->fcm);
    //     $transaksi->update([
    //         'status' => "PROSES"
    //     ]);
    //     return redirect('transaksi');
    // }

    // public function kirim($id){
    //     $transaksi = Transaksi::with(['details.produk', 'user'])->where('id', $id)->first();
    //     $this->pushNotif('Transaksi Dibatalkan', "Transasi produk ".$transaksi->details[0]->produk->name." berhsil dibatalkan", $transaksi->user->fcm);
    //     $transaksi->update([
    //         'status' => "DIKIRIM"
    //     ]);
    //     return redirect('transaksi');
    // }

    // public function selesai($id){
    //     $transaksi = Transaksi::with(['details.produk', 'user'])->where('id', $id)->first();

    //     $this->pushNotif('Transaksi Selesai', "Transasi produk ".$transaksi->details[0]->produk->name." Sudah selesai", $transaksi->user->fcm);
    //     $transaksi->update([
    //         'status' => "SELESAI"
    //     ]);
    //     return redirect('transaksi');
    // }
}
