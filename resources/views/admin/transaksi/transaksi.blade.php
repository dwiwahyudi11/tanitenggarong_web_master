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
                Table Pesanan
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
                            <th style="width: 200px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($listPanding as $data)
                            <tr>
                                <td>{{ $data->id }}</td>
                                <td>{{ $data->name}}</td>
                                <td>{{"Rp.".number_format($data->total_transfer)}}</td>
                                <td>{{ $data->bank }}</td>
                                <td>{{ $data->status}}</td>
                                <td>
                                    <a href="{{ route('transaksiBatal', $data->id) }}">
                                        <button type="button" class="btn btn-block btn-danger btn-xs">Batal</button>
                                    </a>
                                    <!-- /
                                    <a href="{{ route('transaksiConfirm', $data->id) }}">
                                        <button type="button" class="btn btn btn-success btn-xs">Proses</button>
                                    </a> -->

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