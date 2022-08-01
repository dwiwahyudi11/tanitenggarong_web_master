@extends('layouts/app')

@section('title', 'Read Produk')

@section('content')
<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-3">
				<div class="left-sidebar">
					<h2>Kategori</h2>
					
					<div class="brands_products"><!--brands_products-->
						@foreach($kategori as $ktg)
						<div class="brands-name">
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#"> <span class="pull-right">+</span>{{$ktg->nama_kategori}}</a></li>
							</ul>
						</div>
						@endforeach
					</div><!--/brands_products-->

				</div>
			</div>

			<div class="col-sm-9 padding-right">
				@foreach($data as $dt)
				<div class="product-details"><!--product-details-->
					<div class="col-sm-5">
						<div class="view-product">
							<img src="{{asset('gambar')}}/{{$dt->gambar}}" alt="" />
							
						</div>
						<div id="similar-product" class="carousel slide" data-ride="carousel">
							<!-- Controls -->
							<a class="left item-control" href="#similar-product" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							</a>
							<a class="right item-control" href="#similar-product" data-slide="next">
								<i class="fa fa-angle-right"></i>
							</a>
						</div>

					</div>
					<div class="col-sm-7">
						<div class="product-information"><!--/product-information-->
							<h2>{{$dt->nama_produk}}</h2>
							<p>Nama Toko : {{$dt->name}}</p>
							
							<span>
								<span>Rp {{number_format($dt->harga,0,",",".")}}</span>
								<label>Quantity:</label>
								<form method="post" action="{{route('addcart')}}">
									@csrf
									<input type="text" value="1" min="1" name="qty" max="<?php echo $dt->stok ?>" />
									<input type="hidden" value="{{$dt->id_produk}}" name="produk_id">
									@if(Auth::user())
									<input type="hidden" value="{{Auth::user()->id}}" name="user_id">
									@endif
									<button style="margin-top: 10px;" class="btn btn-fefault btn-sm cart">
										<i class="fa fa-shopping-cart"></i>
										Add to cart
									</button>
								</form>
							</span>
							<p><b>Stok:</b> {{$dt->stok}} Tersedia</p>
							<p><b>Condition:</b> {{$dt->detail}}</p>
							<!-- <p><b>Brand:</b> E-SHOPPER</p> -->
						</div><!--/product-information-->
					</div>
				</div><!--/product-details-->
				@endforeach

			</div>
		</div>
	</div>
</section>
@endsection