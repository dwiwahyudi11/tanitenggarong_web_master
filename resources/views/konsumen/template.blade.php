@extends('layouts/app')

@section('title', 'Dashboard')

@section('content')
<section id="slider"><!--slider-->
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div id="slider-carousel" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
						<li data-target="#slider-carousel" data-slide-to="1"></li>
						<li data-target="#slider-carousel" data-slide-to="2"></li>
					</ol>

					<div class="carousel-inner">
						<div class="item active">
							<div class="col-sm-6">
								<h1><span>TANI</span> TENGGARONG</h1>
								<p>Selamat Datang di portal pemasaran dan penjualan produk hasil pertanian Kecamatan Tenggarong. </p>
								
							</div>
							<div class="col-sm-6">
								<img src="{{asset('konsumen/website/pertanian.jpg')}}" class="girl img-responsive" alt="" />
								
							</div>
						</div>
						<div class="item">
							<div class="col-sm-6">
								<h1><span>TANI</span> TENGGARONG</h1>
								<p>Selamat Datang di portal pemasaran dan penjualan produk hasil pertanian Kecamatan Tenggarong. </p>
								
							</div>
							<div class="col-sm-6">
								<img src="{{asset('konsumen/website/perkebunan.jpeg')}}" class="girl img-responsive" alt="" />
								
							</div>
						</div>

						<div class="item">
							<div class="col-sm-6">
								<h1><span>TANI</span> TENGGARONG</h1>
								<p>Selamat Datang di portal pemasaran dan penjualan produk hasil pertanian Kecamatan Tenggarong. </p>
								
							</div>
							<div class="col-sm-6">
								<img src="{{asset('konsumen/website/kebun_jambu.jpg')}}" class="girl img-responsive" alt="" />
								
							</div>
						</div>

					</div>

					<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
						<i class="fa fa-angle-left"></i>
					</a>
					<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
						<i class="fa fa-angle-right"></i>
					</a>
				</div>

			</div>
		</div>
	</div>
</section><!--/slider-->
<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-3">
				<div class="left-sidebar">
					<h2>Kategori</h2>
					<div class="brands_products"><!--category-productsr-->
						@foreach($kategori as $ktg)
						<div class="brands-name">
							<ul class="nav nav-pills nav-stacked">
								<li><a href="" onclick="document.location=href='?_token=UDyy9awepYlh2v4qU3qYjYHwpnIGFBQTu6SIjV4D&keyword={{$ktg->nama_kategori}}'"> <span class="pull-right">+</span>{{$ktg->nama_kategori}}</a></li>
							</ul>
						</div>
						@endforeach
					</div><!--/category-products-->

				</div>
			</div>

			<div class="col-sm-9 padding-right">
				<div class="features_items"><!--features_items-->
					<h2 class="title text-center">Produk</h2>
					@foreach($produks as $prd)
					<div class="col-sm-4">
						<div class="product-image-wrapper">
							<div class="single-products">
								<div class="productinfo text-center">
									<img src="{{asset('gambar')}}/{{$prd->gambar}}" alt="" />
									<h2>Rp {{number_format($prd->harga,0,",",".")}}</h2>
									<p>{{$prd->nama_produk}}</p>
									<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
								</div>
								<div class="product-overlay">
									<div class="overlay-content">
										<h2>Rp {{number_format($prd->harga,0,",",".")}}</h2>
										<p>{{$prd->nama_produk}}</p>
										<a href="{{route('read',$prd->id_produk)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
									</div>
								</div>
							</div>
							<div class="choose">
								<ul class="nav nav-pills nav-justified">
									<li><a href="#"><i class="fa fa-plus-square"></i>Stok : {{$prd->stok}}</a></li>
									<li><a href="#"><i class="fa fa-plus-square"></i>Keterangan : {{$prd->detail}}</a></li>
								</ul>
							</div>
						</div>
					</div>
					@endforeach

				</div><!--features_items-->

			</div>
		</div>
	</div>
</section>
@endsection