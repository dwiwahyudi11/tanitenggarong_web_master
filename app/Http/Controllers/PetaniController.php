<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PetaniController extends Controller
{
	public function dashboard()
	{
		return view('petani/dashboard');
	}
	public function biodata()
	{
		$profil=User::join('biodata','biodata.user_id','=','users.id')->where('users.id',Auth::user()->id)->get();
		return view('petani/biodata/biodata',['profil'=>$profil]);
	}
	public function lengkapi(Request $request,$id)
	{
		if ($request->hasFile('foto')) {
			$ambil=$request->file('foto');
			$name=$ambil->getClientOriginalName();
			$namaFileBaru = uniqid();
			$namaFileBaru .= $name;
			$ambil->move(\base_path()."/public/foto", $namaFileBaru);
			DB::table('biodata')->where('user_id',$id)->update([
				'nama_lengkap'=>$request->nama_lengkap,
				'tmp_lahir'=>$request->tmp_lahir,
				'tgl_lahir'=>$request->tgl_lahir,
				'jenis_kelamin'=>$request->jenis_kelamin,
				'alamat'=>$request->alamat,
				'no_telp'=>$request->no_telp,
				'foto'=>$namaFileBaru,
			]);
			DB::table('users')->where('id',$id)->update([
				'email'=>$request->email,
				'name'=>$request->name,
			]);		
		}else{
			DB::table('biodata')->where('user_id',$id)->update([
				'nama_lengkap'=>$request->nama_lengkap,
				'tmp_lahir'=>$request->tmp_lahir,
				'tgl_lahir'=>$request->tgl_lahir,
				'jenis_kelamin'=>$request->jenis_kelamin,
				'alamat'=>$request->alamat,
				'no_telp'=>$request->no_telp,
			]);
			DB::table('users')->where('id',$id)->update([
				'email'=>$request->email,
				'name'=>$request->name,
			]);
		}
		return redirect()->back()->with('biodata','-');
	}
	public function ganti_password(Request $request,$id)
	{
		DB::table('users')->where('id',$id)->update([
			'password'=>hash::make($request->password),
		]);
		return redirect()->back()->with('biodata','-');
	}
	public function kategori()
	{
		$data=DB::table('kategori')->where('toko_id',Auth::user()->id)->get();
		return view('petani/produk/kategori',['data'=>$data]);
	}
	public function addkategori(Request $request)
	{
		DB::table('kategori')->insert([
			'nama_kategori'=>$request->nama_kategori,
			'toko_id'=>Auth::user()->id,
		]);
		return redirect()->back()->with('kategori','-');
	}
	public function deletekategori($id)
	{
		DB::table('kategori')->where('id_kategori',$id)->delete();
		return redirect()->back()->with('delkategori','-');
	}
	public function updatekategori(Request $request,$id)
	{
		DB::table('kategori')->where('id_kategori',$id)->update([
			'nama_kategori'=>$request->nama_kategori
		]);
		return redirect()->back()->with('upkategori','-');
	}
	public function produk()
	{
		$data=DB::table('produk')->join('kategori','kategori.id_kategori','=','produk.kategori_id')->where('produk.toko_id',Auth::user()->id)->get();
		$kategori=DB::table('kategori')->get();
		return view('petani/produk/produk',['data'=>$data,'kategori'=>$kategori]);
	}
	public function addproduk(Request $request)
	{
		if ($request->hasFile('gambar')) {
			$ambil=$request->file('gambar');
			$name=$ambil->getClientOriginalName();
			$namaFileBaru = uniqid();
			$namaFileBaru .= $name;
			$ambil->move(\base_path()."/public/gambar", $namaFileBaru);
			$save=DB::table('produk')->insert([
				'toko_id'=>Auth::user()->id,
				'kategori_id'=>$request->kategori_id,
				'nama_produk'=>$request->nama_produk,
				'harga'=>$request->harga,
				'stok'=>$request->stok,  		
				'detail'=>$request->detail, 
				'gambar'=>$namaFileBaru, 		
			]);
			return redirect()->back()->with('produk','-');
		}
	}
	public function updateproduk(Request $request, $id)
	{
		if($request->hasFile('gambar')){
			$ambil=$request->file('gambar');
			$name=$ambil->getClientOriginalName();
			$namaFileBaru = uniqid();
			$namaFileBaru .= $name;
			$ambil->move(\base_path()."/public/gambar", $namaFileBaru);
			$save=DB::table('produk')->where('id_produk',$id)->update([
				'toko_id'=>Auth::user()->id,
				'kategori_id'=>$request->kategori_id,
				'nama_produk'=>$request->nama_produk,
				'harga'=>$request->harga,
				'stok'=>$request->stok,  		
				'detail'=>$request->detail, 
				'gambar'=>$namaFileBaru, 		
			]);
		}else{
			DB::table('produk')->where('id_produk',$id)->update([
				'toko_id'=>Auth::user()->id,
				'kategori_id'=>$request->kategori_id,
				'nama_produk'=>$request->nama_produk,
				'harga'=>$request->harga,
				'stok'=>$request->stok,  		
				'detail'=>$request->detail, 
			]);
		}
		return redirect()->back()->with('upproduk','-');
	}
	public function deleteproduk($id)
	{
		DB::table('produk')->where('id_produk',$id)->delete();
		return redirect()->back()->with('delproduk','-');
	}

	public function payment()
	{
		$data=DB::table('payment')->where('toko_id',Auth::user()->id)->get();
		return view('petani/payment/payment',['data'=>$data]);
	}
	public function addpayment(Request $request)
	{
		DB::table('payment')->insert([
			'toko_id'=>Auth::user()->id,
			'no_rek'=>$request->no_rek,
			'ket_rek'=>$request->ket_rek,
		]);
		return redirect()->back()->with('payment','-');
	}
	public function updatepayment(Request $request,$id)
	{
		DB::table('payment')->where('id_payment',$id)->update([
			'no_rek'=>$request->no_rek,
			'ket_rek'=>$request->ket_rek,
		]);
		return redirect()->back()->with('uppayment','-');
	}
	public function deletepayment($id)
	{
		DB::table('payment')->where('id_payment',$id)->delete();
		return redirect()->back()->with('delpayment','-');
	}
	public function checkout_konsumen()
	{
		$data=db::table('checkout')->join('produk','produk.id_produk','=','checkout.produk_id')->join('kategori','kategori.id_kategori','=','produk.kategori_id')->join('users','users.id','=','checkout.user_id')->join('biodata','biodata.user_id','=','users.id')->join('pesanan','pesanan.kode','=','checkout.kode_checkout')->where('checkout.toko_id',Auth::user()->id)->get();
		return view('petani/checkout/checkout',['data'=>$data]);
	}
	public function saldo_petani()
	{
		$data=db::table('checkout')->join('produk','produk.id_produk','=','checkout.produk_id')->join('kategori','kategori.id_kategori','=','produk.kategori_id')->join('users','users.id','=','checkout.user_id')->where('checkout.status_bayar','true')->where('checkout.toko_id',Auth::user()->id)->get();
		$saldo=db::table('checkout')->join('produk','produk.id_produk','=','checkout.produk_id')->join('kategori','kategori.id_kategori','=','produk.kategori_id')->join('users','users.id','=','checkout.user_id')->where('checkout.status_bayar','true')->where('checkout.toko_id',Auth::user()->id)->limit('1')->get();
		return view('petani/checkout/saldo',['data'=>$data,'saldo'=>$saldo]);
	}
	public function upload_resi(Request $request,$id)
	{
		if ($request->hasFile('foto')) {
			$ambil=$request->file('foto');
			$name=$ambil->getClientOriginalName();
			$namaFileBaru = uniqid();
			$namaFileBaru .= $name;
			$ambil->move(\base_path()."/public/resi", $namaFileBaru);
			DB::table('checkout')->where('id_checkout',$id)->update([
				'resi'=>$namaFileBaru,
			]);	
		}
		return redirect()->back()->with('resi','-');
	}
	public function update_status(Request $request,$id)
	{
		DB::table('checkout')->where('id_checkout',$id)->update([
			'status_pengiriman'=>$request->status_pengiriman,
		]);
		return redirect()->back()->with('status','-');
	}
}
