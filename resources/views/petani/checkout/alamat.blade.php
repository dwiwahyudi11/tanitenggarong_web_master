<div class="modal fade text-left" id="alamat{{$pesanan_detail->id_checkout}}" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1">Alamat Pengiriman</h5>
                <button type="button" class="close rounded-pill"
                data-bs-dismiss="modal" aria-label="Close">
                <i data-feather="x"></i>
            </button>
        </div>
        <div class="modal-body">
            <div style="width: 100%"><iframe class="form-control" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=720&amp;height=600&amp;hl=en&amp;q={{$pesanan_detail->alamat}}+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
            </div>
            <div class="row">
                <div class="col-lg-4">Nama Pembeli </div>
                <div class="col-lg-1">:</div>
                <div class="col-lg-5"> {{$pesanan_detail->nama_lengkap}}</div>
            </div>
            <div class="row">
                <div class="col-lg-4">Alamat </div>
                <div class="col-lg-1">:</div>
                <div class="col-lg-5"> {{$pesanan_detail->alamat}}</div>
            </div>
            <div class="row">
                <div class="col-lg-4">No Telepon </div>
                <div class="col-lg-1">:</div>
                <div class="col-lg-5"> {{$pesanan_detail->no_telp}}</div>
            </div>
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
    </div>
</div>
</div>