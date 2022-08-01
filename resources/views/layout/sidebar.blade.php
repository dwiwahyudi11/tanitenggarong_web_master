<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="avatar avatar-xl">
                    <img src="{{asset('template/dist/assets/images/faces/1.jpg')}}" alt="Face 1">
                </div>
                <div class="ms-3 name">
                    <h5 class="font-bold">
                        {{Auth::user()->name}}
                    </h5>
                    <h6 class="text-muted mb-0">
                        {{Auth::user()->email}}
                    </h6>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                @if(Auth::user()->level=="Admin")
                <li class="sidebar-item active ">
                    <a href="" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item ">
                    <a href="{{route('profil_admin')}}" class='sidebar-link'>
                        <i class="dripicons dripicons-user"></i>
                        <span>Profil</span>
                    </a>
                </li>

                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="dripicons dripicons-user-group"></i>
                        <span>Data User</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="{{route('user_petani')}}">Petani</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="{{route('user_konsumen')}}">Konsumen</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="dripicons dripicons-suitcase"></i>
                        <span>Data Pesanan</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="{{route('allpesanan')}}">Semua Pesanan</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="{{route('lunas')}}">Sudah Bayar</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="{{route('nonlunas')}}">Belum Bayar</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="dripicons dripicons-suitcase"></i>
                        <span>Teansaksi</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="{{route('transaksi_admin')}}">Transaksi Pesanan</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="{{route('transaksi_selesai')}}">Transaksi Selesai</a>
                        </li>
                    </ul>
                </li>

                <!-- <li class="sidebar-item ">
                    <a href="{{route('transaksi_admin')}}" class='sidebar-link'>
                        <i class="dripicons dripicons-user"></i>
                        <span>Transaksi</span>
                    </a>
                </li> -->
                @endif
                @if(Auth::user()->level=="Petani")
                <li class="sidebar-item active ">
                    <a href="{{route('dashboard')}}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="dripicons dripicons-user-id"></i>
                        <span>Data Profil</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="{{route('biodata')}}">Biodata</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="dripicons dripicons-suitcase"></i>
                        <span>Data Produk</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="{{route('produk')}}">Produk</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="{{route('kategori')}}">Kategori</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="dripicons dripicons-wallet"></i>
                        <span>Data Payment</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="{{route('payment')}}">Kode Rek</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-title">Pemesanan &amp; Checkout</li>

                <li class="sidebar-item ">
                    <a href="{{route('checkout_konsumen')}}" class='sidebar-link'>
                        <i class="dripicons dripicons-store"></i>
                        <span>Checkout</span>
                    </a>
                </li>
                <li class="sidebar-item ">
                    <a href="{{route('saldo_petani')}}" class='sidebar-link'>
                        <i class="dripicons dripicons-disc"></i>
                        <span>Saldo</span>
                    </a>
                </li>
                @endif

                <li class="sidebar-title">Sign-Out</li>

                <li class="sidebar-item  ">
                    <a href="{{route('logout')}}" class='sidebar-link'>
                        <i class="dripicons dripicons-exit"></i>
                        <span>Logout</span>
                    </a>
                </li>

            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>