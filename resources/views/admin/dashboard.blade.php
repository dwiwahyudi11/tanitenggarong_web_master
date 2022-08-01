@extends('layout/app')

@section('title', 'Dashboard')

@section('content')
<div class="page-heading">
    <h3>Dashboard Admin</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="col-12 col-xl-12">
            <div class="row">
                <div class="col-5 col-lg-5 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon purple">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Jumlah Petani</h6>
                                    <h6 class="font-extrabold mb-0"></h6>
                                    <h6 class="font-extrabold mb-0">2</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-5 col-lg-5 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon blue">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Jumlah Konsumen</h6>
                                    <h6 class="font-extrabold mb-0"></h6>
                                    <h6 class="font-extrabold mb-0">1</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>

            <div class="row">
                <div class="col-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Form Pemesan</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-lg">
                                    <thead>
                                        <tr>
                                            <th>Nama Pelanggan</th>
                                            <th>Tanggal - Kode </th>
                                            <th>Status User</th>
                                            <th>Status Pesanan & Bayar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pesanan as $dt)
                                        <tr>
                                            <td class="col-auto">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-md">
                                                        @if($dt->jenis_kelamin=="LAKI-LAKI")
                                                        <img src="{{asset('template/dist/assets/images/faces/2.jpg')}}">
                                                        @endif
                                                        @if($dt->jenis_kelamin=="PEREMPUAN")
                                                        <img src="{{asset('template/dist/assets/images/faces/5.jpg')}}">
                                                        @endif
                                                    </div>
                                                    <p class="font-bold ms-3 mb-0">{{$dt->nama_lengkap}}</p> 
                                                    <br> 
                                                </div>
                                            </td>
                                            <td class="col-auto">
                                                <p class=" mb-0">{{$dt->tgl_pesanan}}</p>
                                                <p class=" mb-0">Kode Pesanan : {{$dt->kode}}</p>
                                            </td>
                                            <td class="col-auto">
                                                <p class=" mb-0"> 
                                                    Jenis Kelamin : {{$dt->jenis_kelamin}}
                                                </p>
                                                <p class=" mb-0"> 
                                                    WA/Ponsel : 
                                                    @if(substr($dt->no_telp,0,1)=='0')
                                                    <a href="https://wa.me/62{{substr($dt->no_telp,1)}}" target="_blank">
                                                        62 {{substr($dt->no_telp,1)}}
                                                    </a>
                                                    @else
                                                    <span style="color: red;">Format Nomor Salah.</span>
                                                    @endif
                                                </p>
                                            </td>
                                            <td class="col-auto">
                                                <p class=" mb-0">Keterangan : 
                                                    @if($dt->status_tf=="-")
                                                    <span class="badge bg-warning">Belum di Konfirmasi</span>
                                                    @else
                                                    <span class="badge bg-primary">{{$dt->status_tf}}</span>
                                                    @endif
                                                </p>
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
        </div>
        
    </section>
</div>
@endsection