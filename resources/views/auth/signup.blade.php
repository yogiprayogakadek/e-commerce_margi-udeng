<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>E-Commerce Margi Udeng</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/main/images/favicon.ico')}}">

    <!-- owl.carousel css -->
    <link rel="stylesheet" href="{{asset('assets/main/libs/owl.carousel/assets/main/owl.carousel.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets/main/libs/owl.carousel/assets/main/owl.theme.default.min.css')}}">

    <!-- Bootstrap Css -->
    <link href="{{asset('assets/main/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('assets/main/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('assets/main/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{asset('assets/main/libs/sweetalert2/sweetalert2.min.css')}}">
</head>

<body class="auth-body-bg">

    <div>
        <div class="container-fluid p-0">
            <div class="row g-0">

                <div class="col-xl-9">
                    <div class="auth-full-bg pt-lg-5 p-4">
                        <div class="w-100">
                            <div class="bg-overlay"></div>
                            <div class="d-flex h-100 flex-column">

                                <div class="p-4 mt-auto">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-7">
                                            {{-- <div class="text-center">

                                                <h4 class="mb-3"><i class="bx bxs-quote-alt-left text-primary h1 align-middle me-3"></i><span class="text-primary">5k</span>+ Satisfied clients</h4>

                                                <div dir="ltr">
                                                    <div class="owl-carousel owl-theme auth-review-carousel" id="auth-review-carousel">
                                                        <div class="item">
                                                            <div class="py-3">
                                                                <p class="font-size-16 mb-4">" Fantastic theme with a ton of options. If you just want the HTML to integrate with your project, then this is the package. You can find the files in the 'dist' folder...no need to install git and all the other stuff the documentation talks about. "</p>

                                                                <div>
                                                                    <h4 class="font-size-16 text-primary">Abs1981</h4>
                                                                    <p class="font-size-14 mb-0">- Skote User</p>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="item">
                                                            <div class="py-3">
                                                                <p class="font-size-16 mb-4">" If Every Vendor on Envato are as supportive as Themesbrand, Development with be a nice experience. You guys are Wonderful. Keep us the good work. "</p>

                                                                <div>
                                                                    <h4 class="font-size-16 text-primary">nezerious</h4>
                                                                    <p class="font-size-14 mb-0">- Skote User</p>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->

                <div class="col-xl-3">
                    <div class="auth-full-page-content p-md-5 p-4">
                        <div class="w-100">

                            <div class="d-flex flex-column h-100">
                                {{-- <div class="mb-4 mb-md-5">
                                    <a href="index.html" class="d-block auth-logo">
                                        <img src="{{asset('assets/main/images/web/logo.png')}}" alt="" height="40" class="auth-logo-dark">
                                        <img src="{{asset('assets/main/images/web/logo.png')}}" alt="" height="40" class="auth-logo-light">
                                    </a>
                                </div> --}}
                                <div class="my-auto">

                                    <div>
                                        <h5 class="text-primary">Selamat datang !</h5>
                                        <p class="text-muted">Mohon isi semua field berikut</p>
                                    </div>

                                    <div class="mt-4">
                                        <form action="{{route('signup.signup')}}" id="signup" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="type" id="type" value="signup">
                                            <div class="mb-3">
                                                <label for="nama" class="form-label">Nama</label>
                                                <input type="text" class="form-control" id="nama" name="nama" placeholder="masukkan nama">
                                            </div>

                                            <div class="mb-3">
                                                <label for="alamat" class="form-label">Alamat</label>
                                                <textarea class="form-control" id="alamat" name="alamat" placeholder="masukkan alamat" rows="3"></textarea>
                                            </div>

                                            <div class="mb-3">
                                                <label for="jenis-kelamin" class="form-label">Jenis Kelamin</label>
                                                <select class="form-select" id="jenis-kelamin" name="jenis_kelamin">
                                                    <option value="">Pilih jenis kelamin....</option>
                                                    <option value="Laki-laki">Laki-laki</option>
                                                    <option value="Perempuan">Perempuan</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="telp" class="form-label">No. telp</label>
                                                <input type="text" class="form-control" id="telp" name="telp" placeholder="masukkan no. telp">
                                            </div>

                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="text" class="form-control" id="email" name="email" placeholder="masukkan email">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Password</label>
                                                <div class="input-group auth-pass-inputgroup">
                                                    <input type="password" class="form-control" placeholder="masukkan password" aria-label="Password" aria-describedby="password-addon" name="password">
                                                    <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="foto" class="form-label">Foto</label>
                                                <input type="file" class="form-control" id="foto" name="foto" placeholder="masukkan foto">
                                            </div>

                                            <div class="mt-3 d-grid">
                                                <button class="btn btn-primary waves-effect waves-light" type="submit">Daftar</button>
                                            </div>
                                        </form>
                                        <div class="mt-5 text-center">
                                            <p>Sudah punya akun ? <a href="{{route('login')}}" class="fw-medium text-primary"> Login sekarang </a> </p>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>

    <!-- JAVASCRIPT -->
    <script src="{{asset('assets/main/libs/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/main/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/main/libs/metismenu/metisMenu.min.js')}}"></script>
    <script src="{{asset('assets/main/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('assets/main/libs/node-waves/waves.min.js')}}"></script>

    <!-- owl.carousel js -->
    <script src="{{asset('assets/main/libs/owl.carousel/owl.carousel.min.js')}}"></script>

    <!-- auth-2-carousel init -->
    <script src="{{asset('assets/main/js/pages/auth-2-carousel.init.js')}}"></script>

    <!-- App js -->
    <script src="{{asset('assets/main/js/app.js')}}"></script>
    <script src="{{asset('assets/main/libs/sweetalert2/sweetalert2.min.js')}}"></script>

    <!-- Laravel Javascript Validation -->
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

    {!! JsValidator::formRequest('App\Http\Requests\AuthRequest', '#signup') !!}

    <script>
        @if (session('status') == 'error')
            Swal.fire(
                "{{session('title')}}",
                "{{session('message')}}",
                "{{session('status')}}",
            );
        @endif
    </script>
</body>

</html>
