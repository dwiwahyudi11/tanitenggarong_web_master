@extends('layout/app')

@section('title','Data Konsumen')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Konsumen</h3>
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
                Table With Data Konsumen
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="table1">
                    <thead>
                        <tr>
                            <th>No. </th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>Ponsel</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; ?>
                        @foreach($user as $dt)
                        <tr>
                            <td>{{$no}}. </td>
                            <td>{{$dt->nama_lengkap}}</td>
                            <td>{{$dt->email}}</td>
                            <td>{{$dt->tmp_lahir}}, {{$dt->tgl_lahir}}</td>
                            <td>{{$dt->jenis_kelamin}}</td>
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