@extends('layout/app')

@section('title','Data Pesanan')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Pesanan</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Table</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                Table With Data Pesanan
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No. </th>
                            <th>Tanggal</th>
                            <th>Kode Pesanan</th>
                            <th>Bukti Transfer</th>
                            <th>Status Pesanan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; ?>
                        @foreach($pesanan as $dt)
                        <tr>
                            <td>{{$no}}. </td>
                            <td>{{$dt->tgl_pesanan}}</td>
                            <td>{{$dt->kode}}</td>
                            <td>
                                @if($dt->bukti_tf=="-")
                                <span class="badge bg-danger">Belum Bayar</span>
                                @else
                                <span class="badge bg-success">Sudah Bayar</span> <br>
                                <a href="{{route('cek_pesanan',$dt->kode)}}">
                                    <span class="badge bg-primary">Cek?</span>
                                </a>
                                @endif
                            </td>
                            <td>
                                @if($dt->status_tf=="-")
                                <span class="badge bg-warning">Menunggu Konfirmasi</span>
                                @else
                                <span class="badge bg-primary">{{$dt->status_tf}}</span>
                                @endif
                            </td>
                            <td align="center">
                                <a href="{{route('cek_pesanan',$dt->kode)}}" class="btn btn-sm rounded-pill btn-success">
                                    Cek
                                </a>
                            </td>
                        </tr>
                        <?php $no++ ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>
@endsection