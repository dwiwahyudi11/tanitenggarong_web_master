@extends('layout/app')

@section('title','Data Petani')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Petani</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Table</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                Table With Data Petani
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="table1">
                    <thead>
                        <tr>
                            <th>No. </th>
                            <th>Nama Toko</th>
                            <th>Email</th>
                            <th>Nama Lengkap</th>
                            <th>Alamat</th>
                            <th>Ponsel</th>
                            <th>No Rekening</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; ?>
                        @foreach($user as $dt)
                        <tr>
                            <td>{{$no}}. </td>
                            <td>{{$dt->name}}</td>
                            <td>{{$dt->email}}</td>
                            <td>{{$dt->nama_lengkap}}</td>
                            <td>{{$dt->alamat}}</td>
                            <td>
                                @if(substr($dt->no_telp,0,1)=='0')
                                <a href="https://wa.me/62{{substr($dt->no_telp,1)}}" target="_blank">
                                    62 {{substr($dt->no_telp,1)}}
                                </a>
                                @else
                                <span style="color: red;">Format Nomor Salah.</span>
                                @endif
                            </td>
                            <td align="center">
                                <a href="" data-bs-toggle="modal"
                                data-bs-target="#edit{{$dt->id}}" class="btn btn-sm rounded-pill btn-primary">
                                <i class="dripicons dripicons-disc"></i></a>
                            </td>
                        </tr>
                        <div class="modal fade text-left" id="edit{{$dt->id}}" tabindex="-1" role="dialog"
                            aria-labelledby="myModalLabel1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="myModalLabel1">Data Rekening</h5>
                                        <button type="button" class="close rounded-pill"
                                        data-bs-dismiss="modal" aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        @foreach($rekening as $rkg)
                                        @if($rkg->toko_id==$dt->id)
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>No Rekening</label>
                                                <input type="text" class="form-control" readonly="" value="{{$rkg->no_rek}}" name="no_rek">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Keterangan</label>
                                                <input type="text" class="form-control" readonly="" value="{{$rkg->ket_rek}}" name="ket_rek">
                                            </div>  
                                        </div>
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn" data-bs-dismiss="modal">
                                        <i class="bx bx-x d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Close</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $no++ ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</section>
</div>
@endsection