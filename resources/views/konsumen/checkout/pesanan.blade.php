@extends('layouts/app')

@section('title', 'Data Checkout')

@section('content')
<section>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<h3><i class="fa fa-shopping-cart"></i> Pesanan </h3>
						<!-- <p align="right">Tanggal Pesan : {{date('Y-m-d')}}</p> -->
						<table class="table table-striped">
							<thead>
								<tr>
									<td>No. </td>
									<td>Tanggal</td>
									<td>Status</td>
									<td>Bukti Transfer</td>
									<td>Subtotal</td>
									<td>Aksi</td>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1; ?>
								@foreach($data as $pesanan_detail)
								<tr>
									<td>
										{{$no++}}. 
									</td>
									<td>
										{{$pesanan_detail->tgl_pesanan}}
									</td>
									<td>
										@if($pesanan_detail->status_tf=="-")
										Menunggu Konfirmasi
										@else
										{{$pesanan_detail->status_tf}}
										@endif
									</td>
									<td>
										@if($pesanan_detail->bukti_tf=="-")
										<button class="btn btn-sm btn-danger">Segera Upload Transfer</button>
										@else
										<button class="btn btn-sm btn-default">Sudah Upload Transfer</button>
										@endif
									</td>
									<td>Rp. {{ number_format($pesanan_detail->subtl,0,",",".") }}</td>
									<td>
										<a href="{{route('riwayatpembelian',$pesanan_detail->kode)}}" class="btn btn-sm btn-success">
											Detail
										</a>
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