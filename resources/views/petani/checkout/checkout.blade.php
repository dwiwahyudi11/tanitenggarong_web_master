@extends('layout/app')

@section('title','Data Checkout')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Detail Checkout</h3>
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
                Table With Data Checkout
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="table1">
                    <thead>
                        <tr>
                            <th>No. </th>
                            <th>Kode Checkout</th>
                            <th>Nama Produk</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Confirm Admin</th>
                            <th>Pembayaran</th>
                            <th>Alamat</th>
                            <th>Total Harga</th>
                            <th>Status Barang</th>
                            <th>Action</th>
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
                            <td>
                                {{$pesanan_detail->kode_checkout}} <br> {{$pesanan_detail->tgl_checkout}}
                            </td>
                            <td>{{ $pesanan_detail->nama_produk }} <br> {{ $pesanan_detail->nama_kategori }}
                            </td>
                            <td align="left">{{ $pesanan_detail->jml }}x</td>
                            <td>Rp. {{ number_format($pesanan_detail->harga_c,0,",",".") }}</td>
                            <td>
                                @if($pesanan_detail->status_tf=="-")
                                <span class="badge bg-warning">Belum di <br> Confirm Admin</span>
                                @else
                                <span class="badge bg-primary">Sudah di Confirm</span>
                                @endif
                            </td>
                            <td align="center">
                                @if($pesanan_detail->bukti_tf=="-")
                                <span class="badge bg-danger">Belum Bayar</span>
                                @else
                                <span class="badge bg-primary">Sudah di Bayar</span>
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                data-bs-target="#alamat{{$pesanan_detail->id_checkout}}">
                                <i class="dripicons dripicons-location"></i>
                            </button>
                        </td>
                        <td>Rp. {{ number_format($total,0,",",".") }}</td>
                        <td align="center">
                            @if($pesanan_detail->status_pengiriman=="Barang di Packing" OR $pesanan_detail->status_pengiriman==NULL)
                            <form method="post" action="{{route('update_status',$pesanan_detail->id_checkout)}}">
                                @csrf
                                <select class="form-control" name="status_pengiriman">
                                    <option value="Barang di Packing" <?php if($pesanan_detail->status_pengiriman=="Barang di Packing"){echo "selected";} ?>>Barang di Packing</option>
                                    <option value="Barang di Kirim" <?php if($pesanan_detail->status_pengiriman=="Barang di Kirim"){echo "selected";} ?>>Barang di Kirim</option>
                                </select>
                                <button class="btn btn-sm btn-secondary mt-1">
                                    <i class="dripicons dripicons-gear"></i>
                                </button>
                            </form>
                            @else
                            <span class="badge bg-success">{{$pesanan_detail->status_pengiriman}}</span>
                            @endif
                        </td>
                        <td>
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                            data-bs-target="#default{{$pesanan_detail->id_checkout}}">
                            <i class="dripicons dripicons-browser-upload"></i>
                        </button>
                    </td>
                </tr>
                @include('petani/checkout/alamat')
                <div class="modal fade text-left" id="default{{$pesanan_detail->id_checkout}}" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="myModalLabel1">Upload Foto Resi</h5>
                                <button type="button" class="close rounded-pill"
                                data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <form method="post" action="{{route('upload_resi',$pesanan_detail->id_checkout)}}" enctype="multipart/form-data">
                            <div class="modal-body">
                                @csrf
                                <p>
                                    <input type="file" class="form-control" name="foto">
                                </p>
                                <p><img src="{{asset('resi')}}/{{$pesanan_detail->resi}}" class="img-thumbnail"></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn" data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Close</span>
                                </button>
                                <button class="btn btn-primary ml-1">
                                    <i class="bx bx-check d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Accept</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
</div>
</div>

</section>
</div>
@endsection