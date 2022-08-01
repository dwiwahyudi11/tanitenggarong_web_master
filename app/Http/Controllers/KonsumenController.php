<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Mail\SendMail;


class KonsumenController extends Controller
{
	public function index(Request $request)
	{
		$keyword=$request->keyword;
		$produks = DB::table('produk')->join('kategori','kategori.id_kategori','=','produk.kategori_id')->where('kategori.nama_kategori','like',"%".$keyword."%")->get();
		$kategori = DB::table('kategori')->select('nama_kategori')->distinct()->get();
		$user = \App\Models\User::all();

		return view('konsumen/template',['produks' => $produks, 'user' => $user,'kategori'=>$kategori]);
	}
	public function read($id)
	{
		$data=DB::table('produk')->join('kategori','kategori.id_kategori','=','produk.kategori_id')->join('users','users.id','=','produk.toko_id')->where('produk.id_produk',$id)->get();
		$kategori = DB::table('kategori')->select('nama_kategori')->distinct()->get();
		return view('konsumen/read/read',['data'=>$data,'kategori'=>$kategori]);
	}
	public function addcart(Request $request)
	{
		$cek=DB::table('cart')->where('user_id',$request->user_id)->where('produk_id',$request->produk_id)->first();
		if ($cek) {
			DB::table('cart')->where('user_id',$request->user_id)->where('produk_id',$request->produk_id)->update([
				'qty'=>$cek->qty+$request->qty,
				'tgl_c'=>date('Y-m-d'),
			]);
		}else{
			DB::table('cart')->insert([
				'user_id'=>$request->user_id,
				'produk_id'=>$request->produk_id,
				'qty'=>$request->qty,
				'tgl_c'=>date('Y-m-d'),
			]);
		}
		return redirect('keranjang');
	}
	public function keranjang()
	{
		$data=DB::table('cart')->join('produk','produk.id_produk','=','cart.produk_id')->join('kategori','kategori.id_kategori','=','produk.kategori_id')->where('cart.user_id',Auth::user()->id)->get();
		$sub=DB::table('cart')->join('produk','produk.id_produk','=','cart.produk_id')->join('kategori','kategori.id_kategori','=','produk.kategori_id')->where('cart.user_id',Auth::user()->id)->limit('1')->get();
		return view('konsumen/cart/cart',['data'=>$data,'sub'=>$sub]);
	}
	public function hapus_cart($id)
	{
		DB::table('cart')->where('id_cart',$id)->delete();
		return redirect()->back()->with('hapuscart','-');
	}
	public function addcheckout(Request $request)
	{
		$karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		$shuffle  = substr(str_shuffle($karakter), 0, 8);
		foreach ($request->pilih as $key => $value) {
				// $kode_checkout=$shuffle;
			DB::table('checkout')->insert([
				'user_id'=>$request->user_id[$key],
				'produk_id'=>$request->produk_id[$key],
				'toko_id'=>$request->toko_id[$key],
				'jml'=>$request->jml[$key],
				'harga_c'=>$request->harga_c[$key],
				'kode_checkout'=>$shuffle,
				'status_bayar'=>'false',
				'tgl_checkout'=>date('Y-m-d'),
			]);
			DB::table('cart')->where('user_id',$request->user_id[$key])->where('produk_id',$request->produk_id[$key])->delete();
		}
		DB::table('pesanan')->insert([
			'kode'=>$shuffle,
			'status_tf'=>'-',
			'bukti_tf'=>'-',
			'tgl_pesanan'=>date('Y-m-d'),
			'subtl'=>$request->subtl,
			'user_id'=>Auth::user()->id,
		]);
		return redirect('riwayatpembelian/'.$shuffle);
	}
	public function riwayatpembelian($kode)
	{
		$data=DB::table('checkout')->join('produk','produk.id_produk','=','checkout.produk_id')->join('users','users.id','=','checkout.user_id')->join('kategori','kategori.id_kategori','=','produk.kategori_id')->join('pesanan','pesanan.kode','=','checkout.kode_checkout')->where('pesanan.kode',$kode)->get();
		$sub=DB::table('checkout')->join('produk','produk.id_produk','=','checkout.produk_id')->join('users','users.id','=','checkout.user_id')->join('kategori','kategori.id_kategori','=','produk.kategori_id')->join('pesanan','pesanan.kode','=','checkout.kode_checkout')->where('pesanan.kode',$kode)->limit('1')->get();
		$pesanan=DB::table('pesanan')->where('kode',$kode)->get();
		$toko=DB::table('users')->get();
		return view('konsumen/checkout/checkout',['data'=>$data,'sub'=>$sub,'pesanan'=>$pesanan,'toko'=>$toko]);
	}
	public function profil_konsumen()
	{
		$data=DB::table('users')->join('biodata','biodata.user_id','=','users.id')->where('users.id',Auth::user()->id)->get();
		return view('konsumen/profil/profil',['data'=>$data]);
	}
	public function konsumen_lengkapi(Request $request,$id)
	{
		if ($request->password=="") {
			DB::table('biodata')->where('user_id',$id)->update([
				'nama_lengkap'=>$request->nama_lengkap,
				'tmp_lahir'=>$request->tmp_lahir,
				'tgl_lahir'=>$request->tgl_lahir,
				'jenis_kelamin'=>$request->jenis_kelamin,
				'alamat'=>$request->alamat,
				'no_telp'=>$request->no_telp,
			]);
		}
		else{
			DB::table('users')->where('id',$id)->update([
				'password'=>hash::make($request->password),
			]);
			DB::table('biodata')->where('user_id',$id)->update([
				'nama_lengkap'=>$request->nama_lengkap,
				'tmp_lahir'=>$request->tmp_lahir,
				'tgl_lahir'=>$request->tgl_lahir,
				'jenis_kelamin'=>$request->jenis_kelamin,
				'alamat'=>$request->alamat,
				'no_telp'=>$request->no_telp,
			]);
		}
		return redirect()->back()->with('konsumen_lengkapi','-');
	}
	public function cek_toko()
	{
		$data=DB::table('users')->join('biodata','biodata.user_id','=','users.id')->where('level','Petani')->get();
		$kategori=DB::table('kategori')->get();
		return view('konsumen/toko/toko',['data'=>$data,'kategori'=>$kategori]);
	}
	public function detail_toko($id)
	{
		$produk = DB::table('produk')->where('toko_id',$id)->get();
		$kategori=DB::table('kategori')->where('toko_id',$id)->get();
		return view('konsumen/toko/detail',['produk'=>$produk,'kategori'=>$kategori]);
	}
	public function data_checkout()
	{
		$data=DB::table('pesanan')->where('user_id',Auth::user()->id)->get();
		return view('konsumen/checkout/pesanan',['data'=>$data]);
	}
	public function upload_bayar(Request $request, $kode)
	{
		if($request->hasFile('gambar')){
			$ambil=$request->file('gambar');
			$name=$ambil->getClientOriginalName();
			$namaFileBaru = uniqid();
			$namaFileBaru .= $name;
			$ambil->move(\base_path()."/public/bayar", $namaFileBaru);
			$save=DB::table('pesanan')->where('kode',$kode)->update([
				'bukti_tf'=>$namaFileBaru, 		
			]);
			return redirect()->back()->with('upload','-');
		}
	}
	public function contact()
	{
		$data=DB::table('users')->join('biodata','biodata.user_id','=','users.id')->where('users.level','Admin')->get();
		return view('konsumen/contact',['data'=>$data]);
	}
	public function confirm_konsumen($id)
	{
		$true=DB::table('checkout')->join('users','users.id','=','checkout.toko_id')->where('checkout.id_checkout',$id)->first();
		if ($true) {
			DB::table('checkout')->where('id_checkout',$id)->update([
				'status_pengiriman'=>'Barang di Terima',
			]);
			DB::table('checkout')->where('id_checkout',$id)->update([
				'status_bayar'=>'true',
			]);
			$details= [
				'body'=>'SALDO PENJUALAN',
				'toko'=>'TOKO '.$true->name,
			];
			\Mail::to($true->email)->send(new \App\Mail\SendMail($details));
		}
		return redirect()->back()->with('confirm_konsumen','-');
	}
}