@extends('layout/app')

@section('title','Data Saldo Penjualan')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Detail Saldo Penjualan</h3>
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
                Table With Data Saldo Penjualan
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No. </th>
                            <th>Kode Checkout</th>
                            <th>Nama Produk</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php $nul=0; ?>
                        @foreach($data as $pesanan_detail)
                        <?php  
                        $total=$pesanan_detail->harga_c*$pesanan_detail->jml;
                        $subtotal=$nul+=$total;
                        ?>
                        <tr>
                            <td>{{ $no++ }}. </td>
                            <td>
                                {{$pesanan_detail->kode_checkout}} / {{$pesanan_detail->tgl_checkout}}
                            </td>
                            <td>{{ $pesanan_detail->nama_produk }} <br> {{ $pesanan_detail->nama_kategori }}
                            </td>
                            <td align="left">{{ $pesanan_detail->jml }}x</td>
                            <td>Rp. {{ number_format($pesanan_detail->harga_c,0,",",".") }}</td>
                            <td>Rp. {{ number_format($total,0,",",".") }}</td>
                        </tr>
                        @endforeach
                        <tr>
                            @foreach($saldo as $sl)
                            @if($saldo)
                            <th colspan="5">Saldo : </th>
                            <th >Rp {{number_format($subtotal,0,",",".")}}</th>
                            @endif
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>
@endsection