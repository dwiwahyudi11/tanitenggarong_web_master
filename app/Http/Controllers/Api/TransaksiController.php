<?php

namespace App\Http\Controllers\API;

use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\User;
use App\Models\Produk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TransaksiController extends Controller
{
    public function store(Request $requset) {
        //nama, email, password
        $validasi = Validator::make($requset->all(), [
            'user_id' => 'required',
            'total_item' => 'required',
            'total_harga' => 'required',
            'name' => 'required',
            // 'jasa_pengiriaman' => 'required',
            // 'ongkir' => 'required',
            // 'total_transfer' => 'required',
            // 'bank' => 'required',
            'phone' => 'required'
        ]);

        if ($validasi->fails()) {
            $val = $validasi->errors()->all();
            return $this->error($val[0]);
        }

        $kode_payment = "INV/PYM/" . now()->format('Y-m-d') . "/" . rand(100, 999);
        $kode_trx = "INV/PYM/" . now()->format('Y-m-d') . "/" . rand(100, 999);
        $kode_unik = rand(100, 999);
        $status = "MENUNGGU";
        $expired_at = now()->addDay();

        $dataTransaksi = array_merge($requset->all(), [
            'kode_payment' => $kode_payment,
            'kode_trx' => $kode_trx,
            'kode_unik' => $kode_unik,
            'status' => $status,
            'expired_at' => $expired_at
        ]);

        \DB::beginTransaction();
        $transaksi = Transaksi::create($dataTransaksi);
        foreach ($requset->produks as $produk) {
            $detail = [
                'transaksi_id' => $transaksi->id,
                'id_produk' => $produk['id'],
                'total_item' => $produk['total_item'],
                'catatan' => $produk['catatan'],
                'total_harga' => $produk['total_harga']
            ];
            $transaksiDetail = TransaksiDetail::create($detail);
        }

        if (!empty($transaksi) && !empty($transaksiDetail)) {
            \DB::commit();
            return response()->json([
                'success' => 1,
                'message' => 'Transaksi Berhasil',
                'transaksi' => collect($transaksi)
            ]);
        } else {
            \DB::rollback();
            return $this->error('Transaksi gagal');
        }
    }

    public function history() {
        $transaksis = Transaksi::with(['user'])->whereHas('user', function ($query) use ($id) {
            $query->whereId($id);
        })->orderBy("id", "desc")->get();

        foreach ($transaksis as $transaksi) {
            $details = $transaksi->details;
            foreach ($details as $detail) {
                $detail->produk;
            }
        }

        if (!empty($transaksis)) {
            return response()->json([
                'success' => 1,
                'message' => 'Transaksi Berhasil',
                'transaksis' => collect($transaksis)
            ]);
        } else {
            $this->error('Transaksi gagal');
        }
    }


// with(['details.produk', 'user'])->
    public function batal($id){
        $transaksi = Transaksi::with(['details.produk','user'])->where('id', $id)->first();
        if ($transaksi){
            // $this->pushNotif('Transaksi Dibatalkan', "Transasi produk ".$transaksi->details[0]->produk->nama_produk." berhsil dibatalkan");

            $transaksi->update([
                'status' => "BATAL"
            ]);
            $this->pushNotif('Transaksi Dibatalkan', "Transasi produk ".$transaksi->details[0]->produk->nama_produk." berhsail dibatalkan", $transaksi->user->fcm);

            return response()->json([
                'success' => 1,
                'message' => 'Berhasil',
                'transaksi' => $transaksi
            ]);
        } else {
            return $this->error('Gagal memuat transaksi');
        }
    }

    public function pushNotif($title, $message, $mFcm) {

        $mData = [
            'title' => $title,
            'body' => $message
        ];
        // $mData = [
        //     'title' => $request->title,
        //     'body' => $request->message
        // ];
        $fcm[] = $mFcm;

        // $fcm[] = "cudxlxYmRGidHfAd_tYArV:APA91bGTCiKQcyck8H8w-hDcTy_gEwlRKqSd9YnQVcq0vIhqBXr1IHsNchg18gFLNvanTn6y-Jdn0_QOgoBHNz9YQ7aAM9WO4rch7x0qOYPW1R2BFlJau0bNmBkGD45-fOSb93aPDNUy";

        $payload = [
            'registration_ids' => $fcm,
            'notification' => $mData
        ];

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
                "Content-type: application/json",
                "Authorization: key=AAAAyrXOeds:APA91bFM8lHGeqJxsOsU3NR4Ce_zu4Gj9OOx3IpNdSbJQiQd8TcdBYXOjScPUkFp4Gc57MmVuHLTY2GeuLLP2x8XsT0bndgXj2qg9Zg8wNHK3mwztwkFPCsV5dR141ia1ypVf0Gt8n_R"
            ),
        ));
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));

        $response = curl_exec($curl);
        curl_close($curl);

        $data = [
            'success' => 1,
            'message' => "Push notif success",
            'data' => $mData,
            'firebase_response' => json_decode($response)
        ];
        return $data;
    }

    public function upload(Request $request, $id){

        $transaksi = Transaksi::with(['details.produk','user'])->where('id', $id)->first();
        if ($transaksi){

            $fileName = '';
            if($request->image->getClientOriginalName()){
                $file = str_replace(' ','',
                $request->image->getClientOriginalName());
                $fileName = date('mYdHs').rand(1,999).'_'.$file;
                $request->image->storeAs('public/transfer', $fileName);
            }else{
                return $this->error('Gagal memuat data');
            }

            $transaksi->update([
                'status' => "DIBAYAR",
                'bukti_transfer'=> $fileName
            ]);
            $this->pushNotif('Transaksi Dibayar', "Transasi produk ".$transaksi->details[0]->produk->nama_produk." berhasil dibayar", $transaksi->user->fcm);

            return response()->json([
                'success' => 1,
                'message' => 'Berhasil',
                'transaksi' => $transaksi
            ]);
        } else {
            return $this->error('Gagal memuat transaksi');
        }
    }

    public function error($pasan) {
        return response()->json([
            'success' => 0,
            'message' => $pasan
        ]);
    }
   
}
