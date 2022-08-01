@extends('layouts/app')

@section('title', 'Keranjang')

@section('content')
<section>
	<?php  
	$cek=DB::table('users')->join('biodata','biodata.user_id','=','users.id')->where('users.id',Auth::user()->id)->get();
	?>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<h3><i class="fa fa-shopping-cart"></i> Cart Shoop</h3>
						<p align="right">Tanggal Pesan : {{date('Y-m-d')}}</p>
						<table class="table table-striped">
							<thead>
								<tr>
									<td>No. </td>
									<td>Gambar</td>
									<td>Nama Produk</td>
									<td>Jumlah</td>
									<td>Harga</td>
									<td>Total Harga</td>
									<td>Aksi</td>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1; ?>
								<?php $nul=0; ?>
								@foreach($data as $pesanan_detail)
								<?php  
								$total=$pesanan_detail->harga*$pesanan_detail->qty;
								$subtotal=$nul+=$total;
								?>
								<form method="post" action="{{route('addcheckout')}}" enctype="multipart/form-data">
									@csrf
									<tr>
										<td>
											{{$no++}}. 
											<input type="checkbox" hidden="" checked="" name="pilih[]">
											<input type="hidden" value="{{$pesanan_detail->user_id}}" name="user_id[]">
											<input type="hidden" value="{{$pesanan_detail->produk_id}}" name="produk_id[]">
											<input type="hidden" value="{{$pesanan_detail->toko_id}}" name="toko_id[]">
											<input type="hidden" value="{{$pesanan_detail->qty}}" name="jml[]">
											<input type="hidden" value="{{$pesanan_detail->harga}}" name="harga_c[]">
										</td>
										<td>
											<a href="{{route('read',$pesanan_detail->id_produk)}}"><img src="{{asset('gambar')}}/{{$pesanan_detail->gambar}}" width="60" alt=""></a>
										</td>
										<td>{{ $pesanan_detail->nama_produk }} <br> {{ $pesanan_detail->nama_kategori }}</td>
										<td align="left">{{ $pesanan_detail->qty }}</td>
										<td>Rp. {{ number_format($pesanan_detail->harga,0,",",".") }}</td>
										<td>Rp. {{ number_format($total,0,",",".") }}</td>
										<td>
											<a href="{{route('hapus_cart',$pesanan_detail->id_cart)}}" class="btn btn-sm btn-danger">
												<i class="fa fa-times"></i>
											</a>
										</tr>
										@endforeach
										@foreach($sub as $sb)
										@if($sub)
										<tr>
											<td colspan="5" align="right"><strong>TOTAL HARGA : </strong></td>
											<td><strong>Rp. {{number_format($subtotal,0,",",".")}}</strong></td>
											<td>
												@foreach($cek as $ck)
												@if($ck->alamat!==NULL)
												<input type="hidden" value="{{$subtotal}}" name="subtl">
												<button class="btn btn-default btn-sm">
													<i class="fa fa-shopping-cart"></i> Check Out
												</button>
												@else
													<a href="{{route('profil_konsumen')}}"><span class="badge">Isi kan Alamat <br> terlebih Dahulu</span></a>
												@endif
												@endforeach
											</td>
										</tr>
									</form>
									@endif
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	@endsection