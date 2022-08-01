@extends('layouts/app')

@section('title', 'Read Produk')

@section('content')
<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-12"> 
				<div class="card">  			   			
					<h2 class="title text-center"><strong>BIODATA</strong></h2> 
					
				</div>
				@foreach($data as $user)
				<div class="col-sm-6">
					<div class="signup-form"><!--sign up form-->
						
						<form method="POST" action="{{route('konsumen_lengkapi',$user->id)}}">
							@csrf

							<p>Email : </p><input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$user->email}}" autocomplete="email">

							<p>Password : </p><input id="password" type="text" class="form-control" name="password">
							
							<p>Nama Lengkap : </p><input id="nama_lengkap" type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" name="nama_lengkap" value="{{$user->nama_lengkap}}" autocomplete="nama_lengkap">

							<p>Alamat : </p><input id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{$user->alamat}}" autocomplete="alamat">

							<p>Tempat Lahir : </p><input id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" name="tmp_lahir" value="{{$user->tmp_lahir}}" autocomplete="tmp_lahir">

							<p>Tanggal Lahir : </p><input id="tgl_lahir" type="date" class="form-control @error('tgl_lahir') is-invalid @enderror" name="tgl_lahir" value="{{$user->tgl_lahir}}" autocomplete="tgl_lahir">

							<p>Jenis Kelamin : </p>
							<select class="form-control" name="jenis_kelamin">
								<option value="LAKI-LAKI">LAKI-LAKI</option>
								<option value="PEREMPUAN">PEREMPUAN</option>
							</select>

							<p>Kontak : </p><input id="kontak" type="number" class="form-control @error('no_telp') is-invalid @enderror" name="no_telp" value="{{$user->no_telp}}">

							<button type="submit" class="btn btn-default">UPDATE</button>
						</form>
					</div><!--/sign up form-->
				</div>

				<br>
				<div class="col-sm-6">
					<div class="signup-form">
						<table class="table">
							<tbody>

								<tr>
									<td>Email</td>
									<td>:</td>
									<td>{{$user->email}}</td>
								</tr>

								<tr>
									<td>Nama Lengkap</td>
									<td>:</td>
									<td>{{$user->nama_lengkap}}</td>
								</tr>

								<tr>
									<td>Tempat Lahir</td>
									<td>:</td>
									<td>{{$user->tmp_lahir}}</td>
								</tr>

								<tr>
									<td>Tanggal Lahir</td>
									<td>:</td>
									<td>{{$user->tgl_lahir}}</td>
								</tr>

								<tr>
									<td>Jenis Kelamin</td>
									<td>:</td>
									<td>{{$user->jenis_kelamin}}</td>
								</tr>

								<tr>
									<td>Alamat</td>
									<td>:</td>
									<td>{{$user->alamat}}</td>
								</tr>

								<tr>
									<td>Kontak</td>
									<td>:</td>
									<td>
										@if(substr($user->no_telp,0,1)=='0')
										<a href="https://wa.me/62{{substr($user->no_telp,1)}}" target="_blank">
											62 {{substr($user->no_telp,1)}}
										</a>
										@else
										<span style="color: red;">Format Nomor Salah.</span>
										@endif
									</td>
								</tr>

								<tr>
									<td>Tanggal Bergabung</td>
									<td>:</td>
									<td>{{$user->created_at}}</td>
								</tr>
							</tbody>

						</table>
						@if($user->alamat==NULL)
						<center><h3>Alamat Why????</h3></center>
						@else
						<iframe class="form-control" style="height: 300px;margin-bottom: 5px;" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=720&amp;height=600&amp;hl=en&amp;q={{$user->alamat}}+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
						@endif
					</div>
				</div>
				@endforeach

			</div>
		</div>
	</div>
</section>
@endsection