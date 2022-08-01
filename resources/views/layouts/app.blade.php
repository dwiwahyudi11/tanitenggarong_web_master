<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>@yield('title')</title>
	<link href="{{asset('konsumen/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{asset('konsumen/css/font-awesome.min.css')}}" rel="stylesheet">
	<link href="{{asset('konsumen/css/prettyPhoto.css')}}" rel="stylesheet">
	<link href="{{asset('konsumen/css/price-range.css')}}" rel="stylesheet">
	<link href="{{asset('konsumen/css/animate.css')}}" rel="stylesheet">
	<link href="{{asset('konsumen/css/main.css')}}" rel="stylesheet">
	<link href="{{asset('konsumen/css/responsive.css')}}" rel="stylesheet">
	<link rel="stylesheet" href="{{asset('template/dist/assets/vendors/toastify/toastify.css')}}">

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
<![endif]-->       
<link rel="shortcut icon" href="images/ico/favicon.ico">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('konsumen/images/ico/apple-touch-icon-144-precomposed.png')}}">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('konsumen/images/ico/apple-touch-icon-114-precomposed.png')}}">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('konsumen/images/ico/apple-touch-icon-72-precomposed.png')}}">
<link rel="apple-touch-icon-precomposed" href="{{asset('konsumen/images/ico/apple-touch-icon-57-precomposed.png')}}">
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		@if(Auth::user())
		<?php  
		$cart=DB::table('cart')->where('user_id',Auth::user()->id)->count();
		?>
		@endif
		<?php 
		$data=DB::table('users')->join('biodata','biodata.user_id','=','users.id')->where('users.level','Admin')->get();
		?>
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-md-4 clearfix">
						<div class="logo pull-left">
								@foreach($data as $dt)
								<h3>{{$dt->name}}</h3>
								@endforeach
						</div>
					</div>
					<div class="col-md-8 clearfix">
						<div class="shop-menu clearfix pull-right">
							<ul class="nav navbar-nav">
								@if(Auth::user())
								<li><a href="{{route('profil_konsumen')}}"><i class="fa fa-user"></i> Account</a></li>
								@endif
								<li><a href="{{route('data_checkout')}}"><i class="fa fa-crosshairs"></i> Checkout</a></li>
								@if(Auth::user())
								<li><a href="{{route('keranjang')}}"><i class="fa fa-shopping-cart"></i> Keranjang <sup>{{$cart}}</sup></a></li>
								@else
								<li><a href="{{route('keranjang')}}"><i class="fa fa-shopping-cart"></i> Keranjang</a></li>
								@endif
								@if(Auth::user())
								<li class="nav-item dropdown">
									<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
										<i class="fa fa-user"></i>{{ Auth::user()->name }}
									</a>

									<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
										<a class="dropdown-item" href="{{ route('logout') }}"
										onclick="event.preventDefault();
										document.getElementById('logout-form').submit();">
										{{ __('Logout') }}
									</a>

									<form id="logout-form" action="{{ route('logout') }}" method="get" class="d-none">
										@csrf
									</form>
								</div>
							</li>
							@else
							<li><a href="{{route('login')}}"><i class="fa fa-lock"></i> Login</a></li>
							<li><a href="{{route('register')}}"><i class="fa fa-edit"></i> Register</a></li>
							@endif
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div><!--/header-middle-->

	<div class="header-bottom"><!--header-bottom-->
		<div class="container">
			<div class="row">
				<div class="col-sm-9">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
					<div class="mainmenu pull-left">
						<ul class="nav navbar-nav collapse navbar-collapse">
							<li><a href="{{route('index')}}" class="active">Home</a></li> 
							<li><a href="{{route('contact')}}">Contact</a></li>
							<li><a href="{{route('cek_toko')}}">Cek Toko</a></li> 
						</ul>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="search_box pull-right">
						<input type="text" placeholder="Search"/>
					</div>
				</div>
			</div>
		</div>
	</div><!--/header-bottom-->
</header><!--/header-->

@yield('content')

<footer id="footer"><!--Footer-->
	<div class="footer-top">
		<div class="container">
			<div class="row">
				<div class="col-sm-2">
					<div class="companyinfo">
						<h2><span>TANI</span>TANGGARONG</h2>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="address">
						<img src="images/home/map.png" alt="" />
						<p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="footer-bottom">
		<div class="container">
			<div class="row">
				<p class="pull-left">Copyright Tani Tenggarong</p>
			</div>
		</div>
	</div>

</footer><!--/Footer-->

<script src="{{asset('template/dist/assets/js/extensions/sweetalert2.js')}}"></script>
<script src="{{asset('template/dist/assets/vendors/sweetalert2/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('template/dist/assets/js/main.js')}}"></script>
<script src="{{asset('template/dist/assets/vendors/toastify/toastify.js')}}"></script>
<script src="{{asset('template/dist/assets/js/extensions/toastify.js')}}"></script>
<script src="{{asset('konsumen/js/jquery.js')}}"></script>
<script src="{{asset('konsumen/js/bootstrap.min.js')}}"></script>
<script src="{{asset('konsumen/js/jquery.scrollUp.min.js')}}"></script>
<script src="{{asset('konsumen/js/price-rang}.jse')}}"></script>
<script src="{{asset('konsumen/js/jquery.prettyPhoto.js')}}"></script>
<script src="{{asset('konsumen/js/main.js')}}"></script>
</body>
@include('layouts/notif')
</html>