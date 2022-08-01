<div class="modal fade text-left" id="edit{{$dt->id_produk}}" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1">Menambah Data Produk</h5>
                <button type="button" class="close rounded-pill"
                data-bs-dismiss="modal" aria-label="Close">
                <i data-feather="x"></i>
            </button>
        </div>
        <form method="post" action="{{route('updateproduk',$dt->id_produk)}}" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Nama Produk</label>
                            <input type="text" class="form-control" value="{{$dt->nama_produk}}" name="nama_produk">
                        </div>  
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Kategori Produk</label>
                            <select class="form-control" name="kategori_id">
                                @foreach($kategori as $ktg)
                                @if($ktg->toko_id==Auth::user()->id)
                                <option <?php if($dt->kategori_id==$ktg->id_kategori){echo "selected";} ?> value="{{$ktg->id_kategori}}">{{$ktg->nama_kategori}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>  
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Harga Produk</label>
                            <input type="text" class="form-control" value="{{$dt->harga}}" name="harga">
                        </div>  
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Stok Produk</label>
                            <input type="text" class="form-control" value="{{$dt->stok}}" name="stok">
                        </div>  
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Detail Produk</label>
                            <input type="text" class="form-control" value="{{$dt->detail}}" name="detail">
                        </div>  
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Gambar Produk</label>
                            <input type="file" class="form-control" name="gambar">
                        </div>  
                    </div>
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
        </form>
    </div>
</div>
</div>