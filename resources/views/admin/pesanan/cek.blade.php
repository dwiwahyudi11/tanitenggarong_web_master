@extends('layout/app')

@section('title','Data Pesanan')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Detail Pesanan</h3>
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
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Nama Produk</td>
                            <td>Jumlah</td>
                            <td>Harga</td>
                            <td>Status Pesanan</td>
                            <td>Total Harga</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php $nul=0; ?>
                        @foreach($data as $pesanan_detail)
                        <?php  
                        $total=$pesanan_detail->harga_c*$pesanan_detail->jml;
                        ?>
                        <tr>
                            <td>{{ $no++ }}. </td>
                            <td>{{ $pesanan_detail->nama_produk }} <br> {{ $pesanan_detail->nama_kategori }} <br>Toko :
                                {{ $pesanan_detail->name }}
                            </td>
                            <td align="left">{{ $pesanan_detail->jml }}x</td>
                            <td>Rp. {{ number_format($pesanan_detail->harga_c,0,",",".") }}</td>
                            <td>
                                @if($pesanan_detail->status_tf=="-")
                                <span class="badge bg-warning">Menunggu Konfirmasi</span>
                                @else
                                <span class="badge bg-primary">{{$pesanan_detail->status_tf}}</span>
                                @endif
                            </td>
                            <td>Rp. {{ number_format($total,0,",",".") }}</td>

                        </tr>
                        @endforeach
                        @foreach($pesanan as $psn)
                        <tr>
                            <td colspan="5" align="right"><strong>TOTAL HARGA : </strong></td>
                            <td><strong>Rp. {{ number_format($psn->subtl,0,",",".") }}</strong></td>
                        </tr>
                        <tr>
                            <td colspan="5" align="right"><strong>KODE CHECKOUT : </strong></td>
                            <td><strong>{{$psn->kode}}</strong></td>
                        </tr>
                        <tr>
                            <td colspan="5" align="right"><strong>TOTAL YANG HARUS DITRANSFER : </strong></td>
                            <td><strong>Rp. {{ number_format($psn->subtl,0,",",".") }}</strong></td>

                        </tr>
                        <tr>
                            <td colspan="5" align="right"><strong>KONFIRMASI : </strong></td>
                            <td>
                                @if($psn->bukti_tf=="-")
                                <span class="badge bg-danger">Menunggu Upload</span>
                                @endif
                                @if($psn->bukti_tf!=='-')
                                <a href="{{asset('bayar')}}/{{$psn->bukti_tf}}" target="_blank"><img src="{{asset('bayar')}}/{{$psn->bukti_tf}}" width="60"></a>
                                <form method="POST" action="{{route('confirm')}}"> 
                                    @csrf
                                    @foreach($data as $dt)
                                    <input type="hidden" value="{{$dt->produk_id}}" name="produk_id[]">
                                    <input type="hidden" value="{{$dt->email}}" name="email[]">
                                    <input type="hidden" value="{{$dt->jml}}" name="jml[]">
                                    <input type="hidden" value="{{$dt->kode}}" name="kode[]">
                                    @endforeach
                                    @if($psn->status_tf=="-")
                                    <button class="btn btn-sm btn-success" style="margin-top: 2px;">Confirm</button>
                                    @else
                                    <span class="badge bg-primary">Sudah Confirm</span>
                                    @endif
                                </form>
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