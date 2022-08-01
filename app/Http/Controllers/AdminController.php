<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Mail\SendMail;
use App\Models\Transaksi;


class AdminController extends Controller
{
	public function dashboard_admin()
	{
		$pesanan=DB::table('pesanan')->join('users','users.id','=','pesanan.user_id')->join('biodata','biodata.user_id','=','users.id')->limit('3')->get();
		return view('admin/dashboard',['pesanan'=>$pesanan]);
	}

	public function allpesanan()
	{
		$pesanan=DB::table('pesanan')->get();
		
		return view('admin/pesanan/pesanan',['pesanan'=>$pesanan]);
	}
	public function lunas()
	{
		$pesanan=DB::table('pesanan')->where('bukti_tf','!=','-')->get();
		return view('admin/pesanan/lunas',['pesanan'=>$pesanan]);
	}
	public function nonlunas()
	{
		$pesanan=DB::table('pesanan')->where('bukti_tf','=','-')->get();
		return view('admin/pesanan/nonlunas',['pesanan'=>$pesanan]);
	}
	public function cek_pesanan($kode)
	{
		$data=DB::table('pesanan')->join('checkout','checkout.kode_checkout','=','pesanan.kode')->join('users','users.id','=','checkout.toko_id')->join('produk','produk.id_produk','checkout.produk_id')->join('kategori','kategori.id_kategori','=','produk.kategori_id')->where('checkout.kode_checkout',$kode)->get();
		$pesanan=DB::table('pesanan')->where('kode',$kode)->get();
		return view('admin/pesanan/cek',['data'=>$data,'pesanan'=>$pesanan]);
	}
	public function profil_admin()
	{
		$data=DB::table('users')->join('biodata','biodata.user_id','=','users.id')->where('users.id',Auth::user()->id)->get();
		return view('admin/profil/profil',['data'=>$data]);
	}
	public function ubah(Request $request,$id)
	{
		DB::table('biodata')->where('user_id',$id)->update([
			'nama_lengkap'=>$request->nama_lengkap,
			'alamat'=>$request->alamat,
			'no_telp'=>$request->no_telp,
		]);
		DB::table('users')->where('id',$id)->update([
			'email'=>$request->email,
			'name'=>$request->name,
		]);		
		return redirect()->back()->with('biodata','-');
	}
	public function user_petani()
	{
		$user=DB::table('users')->join('biodata','biodata.user_id','=','users.id')->where('level','Petani')->get();
		$rekening=DB::table('payment')->get();
		return view('admin/user/petani',['user'=>$user,'rekening'=>$rekening]);
	}
	public function user_konsumen()
	{
		$user=DB::table('users')->join('biodata','biodata.user_id','=','users.id')->where('level','Konsumen')->get();
		return view('admin/user/konsumen',['user'=>$user]);
	}
	public function confirm(Request $request)
	{
		$produk_id=$request->input('produk_id');
		$jml=$request->input('jml');
		DB::table('pesanan')->where('kode',$request->input('kode'))->update([
			'status_tf'=>'Sudah di Konfirmasi',
		]);
		foreach (array_combine($produk_id, $jml) as $produk => $jumlah) {
			$cek=DB::table('produk')->join('users','users.id','=','produk.toko_id')->where('produk.id_produk',$produk)->first();
			if ($cek) {
				DB::table('produk')->join('users','users.id','=','produk.toko_id')->where('produk.id_produk',$produk)->update([
					'stok'=>$cek->stok-$jumlah,
				]);
			}
		}
		return redirect()->back()->with('confirm','-');
	}

	//transaksi pesanan
	public function transaksi_admin()
	{
		$transaksiPading['listPanding'] = Transaksi::whereStatus("MENUNGGU")->get();
        $transaksiSelesai['listDone'] = Transaksi::where("Status", "NOT LIKE", "%MENUNGGU%")->get();
		return view('admin/transaksi/transaksi')->with($transaksiPading)->with($transaksiSelesai);
	}

	public function batal($id){
        $transaksi = Transaksi::with(['details.produk','user'])->where('id', $id)->first();
        $this->pushNotif('Transaksi Diproses', "Transasi produk ".$transaksi->details[0]->produk->nama_produk." berhasil dibatalkan", $transaksi->user->fcm);
        $transaksi->update([
            'status' => "BATAL"
        ]);
        return redirect('admin/transaksi');
    }

    public function konfrim($id){
        $transaksi = Transaksi::with(['details.produk','user'])->where('id', $id)->first();
        $this->pushNotif('Transaksi Diproses', "Transasi produk ".$transaksi->details[0]->produk->nama_produk." sedang diproses", $transaksi->user->fcm);
        // $this->pushNotif('Transaksi Diproses', "Transasi produk ".$transaksi->details[0]->produk->name." sedang diproses", $transaksi->user->fcm);
        $transaksi->update([
            'status' => "PROSES"
        ]);
        return redirect('admin/transaksi');
    }

	public function transaksi_selesai()
	{
		$transaksiPading['listPanding'] = Transaksi::whereStatus("MENUNGGU")->get();
        $transaksiSelesai['listDone'] = Transaksi::where("Status", "NOT LIKE", "%MENUNGGU%")->get();
		return view('admin/transaksi/transaksiselesai')->with($transaksiPading)->with($transaksiSelesai);
	}

	public function kirim($id){
        $transaksi = Transaksi::with(['details.produk','user'])->where('id', $id)->first();
        $this->pushNotif('Transaksi Diproses', "Transasi produk ".$transaksi->details[0]->produk->nama_produk." sedang dikirim", $transaksi->user->fcm);
        $transaksi->update([
            'status' => "DIKIRIM"
        ]);
        return redirect('admin/transaksiselesai');
    }

    public function selesai($id){
        $transaksi = Transaksi::with(['details.produk','user'])->where('id', $id)->first();
        $this->pushNotif('Transaksi Diproses', "Transasi produk ".$transaksi->details[0]->produk->nama_produk." selesai, silahkan cek pesanan anda", $transaksi->user->fcm);

        $transaksi->update([
            'status' => "SELESAI"
        ]);
        return redirect('admin/transaksiselesai');
    }

	public function pushNotif($title, $message, $mFcm) {

        $mData = [
            'title' => $title,
            'body' => $message
        ];
        
        $fcm[] = $mFcm;

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


}