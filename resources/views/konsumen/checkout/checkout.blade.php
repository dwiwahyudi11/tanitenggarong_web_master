@extends('layouts/app')

@section('title', 'Checkout')

@section('content')
<section>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<h3>Data Detail Check Out</h3>
						<p>Pesanan anda sudah sukses dicheck out. Selanjutnya untuk pembayaran silahkan transfer di rekening <strong>Bank BRI Nomor Rekening : 12345-123456-123</strong> <br> dengan nominal : <strong>Rp. 
							@foreach($pesanan as $psn)
							{{ number_format($psn->subtl,0,",",".")}}
							@endforeach
						</strong></p>
					</div>
				</div>

			</div>
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<h3><i class="fa fa-shopping-cart"></i> Detail Pemesanan</h3>
						<p align="right">Tanggal Pesan : 
							@foreach($pesanan as $psn)
							{{$psn->tgl_pesanan}}
							@endforeach
						</p>
						<table class="table table-striped">
							<thead>
								<tr>
									<td>No</td>
									<td>Gambar</td>
									<td>Nama Produk</td>
									<td>Status Barang</td>
									<td>Resi Barang</td>
									<td>Jumlah</td>
									<td>Harga</td>
									<td>Total Harga</td>
									<td>Action</td>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1; ?>
								<?php $nul=0; ?>
								@foreach($data as $pesanan_detail)
								<?php  
								$total=$pesanan_detail->harga_c*$pesanan_detail->jml;
								?>
								<tr>
									<td>{{ $no++ }}. </td>
									<td>
										<img src="{{ url('gambar') }}/{{ $pesanan_detail->gambar }}" width="60" alt="">
									</td>
									<td>{{ $pesanan_detail->nama_produk }} <br> {{ $pesanan_detail->nama_kategori }} <br>Toko :
										@foreach($toko as $tk)
										@if($pesanan_detail->toko_id==$tk->id)
										{{ $tk->name }}
										@endif
										@endforeach
									</td>
									<td>
										@if($pesanan_detail->status_pengiriman==NULL)
										Belum ada penyiapan barang
										@else
										{{$pesanan_detail->status_pengiriman}}
										@endif
									</td>
									<td>
										@if($pesanan_detail->resi!==NULL)
										<a href="{{ url('resi') }}/{{$pesanan_detail->resi}}" target="_blank"><img src="{{asset('resi')}}/{{$pesanan_detail->resi}}" width="60"></a>
										@endif
									</td>
									<td align="left">{{ $pesanan_detail->jml }}x</td>
									<td>Rp. {{ number_format($pesanan_detail->harga_c,0,",",".") }}</td>
									<td>Rp. {{ number_format($total,0,",",".") }}</td>
									<form method="get" action="{{route('confirm_konsumen',$pesanan_detail->id_checkout)}}">
										@csrf
										<td>
											@if($pesanan_detail->status_pengiriman=="Barang di Kirim")
											<button class="btn btn-sm btn-warning">Confirm</button>
											@else
											<span class="badge">{{$pesanan_detail->status_pengiriman}}</span>
											@endif
										</td>
									</form>

								</tr>
								@endforeach
								@foreach($pesanan as $psn)
								<tr>
									<td colspan="8" align="right"><strong>TOTAL HARGA : </strong></td>
									<td><strong>Rp. {{ number_format($psn->subtl,0,",",".") }}</strong></td>
								</tr>
								<tr>
									<td colspan="8" align="right"><strong>KODE CHECKOUT : </strong></td>
									<td><strong>{{$psn->kode}}</strong></td>
								</tr>
								<tr>
									<td colspan="8" align="right"><strong>TOTAL YANG HARUS DITRANSFER : </strong></td>
									<td><strong>Rp. {{ number_format($psn->subtl,0,",",".") }}</strong></td>

								</tr>
								<tr>
									<td colspan="8" align="right"><strong>UPLOAD BUKTI TRANSFER : </strong></td>
									<td>
										@if($psn->bukti_tf=="-")
										<form method="POST" action="{{route('upload_bayar',$psn->kode)}}" enctype="multipart/form-data"> 
											{{ csrf_field() }}
											<input type="file" style="width: 80px;" name="gambar">
											<button onclick="return confirm('Lanjutkan Upload Bukti Trasnfer?');" class="btn btn-sm btn-success" style="margin-top: 2px;">Kirim</button>
										</form>
										@endif
										@if($psn->bukti_tf!=='-')
										<img src="{{asset('bayar')}}/{{$psn->bukti_tf}}" width="60">
										@endif
									</td>
								</tr>
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