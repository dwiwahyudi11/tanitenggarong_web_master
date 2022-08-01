     @extends('layout/app')
     @section('title','Profil Admin')
     @section('content')
     <div class="page-heading">

        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h2>Profil</h2>
                    <button type="button" class="btn rounded-pill btn-sm btn-warning block" style="float: right;" data-bs-toggle="modal" data-bs-target="#inlineForm">
                        <i class="icon dripicons-document-edit"></i> Lengkapi
                    </button>
                    <button type="button" class="btn rounded-pill btn-sm btn-primary block" style="float: right;" data-bs-toggle="modal" data-bs-target="#password">
                        <i class="bi bi-shield-lock"></i> Ganti Password
                    </button>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tbody>
                            @foreach($data as $cst)
                            <tr>
                                <td>EMAIL TOKO</td>
                                <td>:</td>
                                <td>{{$cst->email}}</td>
                            </tr>
                            <tr>
                                <td>NAMA TOKO</td>
                                <td>:</td>
                                <td>{{$cst->name}}</td>
                            </tr>
                            <tr>
                                <td>NAMA LENGKAP</td>
                                <td>:</td>
                                <td>{{$cst->nama_lengkap}}</td>
                            </tr>
                            <tr>
                                <td>PONSEL</td>
                                <td>:</td>
                                <td>{{$cst->no_telp}}</td>
                            </tr>
                            <tr>
                                <td>ALAMAT</td>
                                <td>:</td>
                                <td>{{$cst->alamat}}</td>
                            </tr>
                            <div class="modal fade text-left" id="password" tabindex="-1"
                            role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                            <div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable"
                            role="document">
                            <div class="modal-content" style="border-bottom:1px solid blue;">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel33">UBAH PASSWORD </h4>
                                    <button type="button" class="close" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <form method="post" action="{{route('ganti_password',$cst->id)}}">
                                @csrf
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <label>PASSWORD:</label>
                                            <div class="form-group">
                                                <input type="text" name="password"
                                                class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light-secondary"
                                    data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Close</span>
                                </button>
                                <button type="submit" class="btn btn-primary ml-1">
                                    <i class="bx bx-check d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Accept</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade text-left" id="inlineForm" tabindex="-1"
            role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable"
            role="document">
            <div class="modal-content" style="border-bottom:1px solid blue;">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">SETING PROFIL </h4>
                    <button type="button" class="close" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form method="post" action="{{route('ubah',$cst->id)}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <label>EMAIL:</label>
                            <div class="form-group">
                                <input type="email" name="email" value="{{$cst->email}}"
                                class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label>NAMA TOKO:</label>
                            <div class="form-group">
                                <input type="text" name="name" value="{{$cst->name}}"
                                class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label>NAMA LENGKAP: </label>
                            <div class="form-group">
                                <input type="text" name="nama_lengkap" value="{{$cst->nama_lengkap}}"
                                class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label>PONSEL: </label>
                            <div class="form-group">
                                <input type="number" name="no_telp" value="{{$cst->no_telp}}"
                                class="form-control">
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <label>ALAMAT: </label>
                            <div class="form-group">
                                <textarea class="form-control" rows="4" name="alamat">{{$cst->alamat}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary"
                    data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
                <button type="submit" class="btn btn-primary ml-1">
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
<div class="row mb-4">
    @foreach($data as $cst)
    @if($cst->alamat==NULL)
    <div class="alert alert-light-danger color-danger"><i
        class="bi bi-exclamation-circle"></i> ALAMAT TIDAK DI KETAHUI</div>
        @else
        <div class="col-12"><iframe class="form-control" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=720&amp;height=600&amp;hl=en&amp;q={{$cst->alamat}}+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
        </div>
        @endif

        @endforeach
    </div>
    @endsection