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
                Table Proses 
            </div>
            <div class="card-body ">
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th style="width: 10px">N0</th>
                            <th>Nama Pembeli</th>
                            <th>Total</th>
                            <th>Bank</th>
                            <th>Status</th>
                            <th>Bukti Transfer</th>
                            <th style="width: 200px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($listDone as $data)
                            <tr>
                                <td>{{ $data->id }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{"Rp.".number_format($data->total_transfer)}}</td>
                                <td>{{ $data->bank }}</td>
                                <td>{{ $data->status}}</td>
                                <td><a href="{{ asset('/storage/transfer/'.$data->bukti_transfer) }}" target="_blank">Lihat Bukti Pembayaran</a></td>
                                <td>
                                    @if($data->status == "DIKIRIM")
                                        <a href="{{ route('transaksiSelesai', $data->id) }}">
                                            <button type="button" class="btn btn-block btn-primary btn-xs">Selesai
                                            </button>
                                        </a>
                                    @elseif($data->status == "DIBAYAR")
                                        <a href="{{ route('transaksiConfirm', $data->id) }}">
                                            <button type="button" class="btn btn-block btn-info btn-xs">Proses
                                            </button>
                                        </a>
                                    @elseif($data->status == "PROSES")
                                        <a href="{{ route('transaksiKirim', $data->id) }}">
                                            <button type="button" class="btn btn-block btn-success btn-xs">Kirim
                                            </button>
                                        </a>
                                    @elseif($data->status == "SELESAI" || $data->status == "BATAL")
                                        <a href="#">
                                            <button type="button" class="btn btn-block btn-info btn-xs">Detail
                                            </button>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    
                </table>
            </div>
        </div>

    </section>
</div>
@endsection