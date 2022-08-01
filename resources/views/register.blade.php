<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('template/dist/assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('template/dist/assets/vendors/bootstrap-icons/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{asset('template/dist/assets/css/app.css')}}">
    <link rel="stylesheet" href="{{asset('template/dist/assets/css/pages/auth.css')}}">
</head>

<body>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <!-- <div class="auth-logo">
                        <a href="index.html"><img src="assets/images/logo/logo.png" alt="Logo"></a>
                    </div> -->
                    <h1 class="auth-title">Sign Up</h1>
                    <!-- <p class="auth-subtitle mb-5">Input your data to register to our website.</p> -->
                    <form action="{{route('daftar')}}" method="post">
                        @csrf
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="email" class="form-control form-control-xl" name="email" placeholder="Email">
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <select class="form-control form-control-xl" name="level">
                                <option>------ Pilih ------</option>
                                <option value="Konsumen">Konsumen</option>
                                <option value="Petani">Petani</option>
                            </select>
                            <div class="form-control-icon">
                                <i class="bi bi-hourglass"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" name="password" placeholder="Password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" name="confirm" placeholder="Confirm Password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-2">Sign Up</button>
                    </form>
                    <div class="text-center mt-3 text-lg fs-4">
                        <p class='text-gray-600'>Sudah Punya Akun? <a href="{{route('login')}}"
                            class="font-bold">Log
                        in</a>.</p>
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
<script src="{{asset('template/dist/assets/js/extensions/sweetalert2.js')}}"></script>
<script src="{{asset('template/dist/assets/vendors/sweetalert2/sweetalert2.all.min.js')}}"></script>
</html>
@if(session('sama'))
<script type="text/javascript">
    document.getElementById('warning');
    Swal.fire({
        icon: "warning",
        title: "Email terdaftar",
        text: "Email telah terdaftar, coba gunakan Email lain."
    });
</script>
@endif
@if(session('confirm'))
<script type="text/javascript">
    document.getElementById('error');
    Swal.fire({
        icon: "error",
        title: "Konfirmasi Password Salah.",
    });
</script>
@endif