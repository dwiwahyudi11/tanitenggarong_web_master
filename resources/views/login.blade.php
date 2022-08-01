<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('template/dist/assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('template/dist/assets/vendors/bootstrap-icons/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{asset('template/dist/assets/css/app.css')}}">
    <link rel="stylesheet" href="{{asset('template/dist/assets/css/pages/auth.css')}}">
    <link rel="stylesheet" href="{{asset('template/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.css')}}">
</head>

<body>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <!-- <div class="auth-logo">
                        <a href="index.html"><img src="{{asset('template/dist/assets/images/logo/logo.png')}}" alt="Logo"></a>
                    </div> -->
                    <h1 class="auth-title">Log in.</h1>
                    <p class="auth-subtitle mb-3">Lengkapi Data Anda</p>
                    <form action="{{route('ceklogin')}}" method="post">
                        @csrf
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="email" class="form-control form-control-xl" name="email" placeholder="Email">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" name="password" placeholder="Password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <div class="form-check form-check-lg d-flex align-items-end">
                            <input class="form-check-input me-2" checked="" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label text-gray-600" for="flexCheckDefault">
                                Keep me logged in
                            </label>
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class='text-gray-600'>Tidak ada Akun? <a href="{{route('register')}}"
                            class="font-bold">Sign-Up</a>.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 d-none d-lg-block">
                    <div id="auth-right">

                    </div>
                </div>
            </div>

        </div>
    </body>
    <script src="{{asset('template/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('template/dist/assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('template/dist/assets/js/main.js')}}"></script>
    <script src="{{asset('template/dist/assets/js/extensions/sweetalert2.js')}}"></script>
    <script src="{{asset('template/dist/assets/vendors/sweetalert2/sweetalert2.all.min.js')}}"></script>
    </html>
    @if(session('salah'))
    <script type="text/javascript">
        document.getElementById('error');
        Swal.fire({
            icon: "error",
            title: "Gagal Login",
            text: "Email dan Password tidak sesuai."
        });
    </script>
    @endif
    @if(session('yes'))
    <script type="text/javascript">
        document.getElementById('success');
        Swal.fire({
            icon: "success",
            title: "Register Berhasil, Silahkan Login",
        });
    </script>
    @endif