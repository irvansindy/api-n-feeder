
<!DOCTYPE html>
<html lang="en" dir="ltr" data-bs-theme="light" data-color-theme="Blue_Theme" data-layout="vertical">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/favicon.png') }}"/>

    <!-- Core Css -->
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}" />

    <title>MatDash Bootstrap Admin</title>
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <img src="{{ asset('assets/images/logos/favicon.png') }}" alt="loader" class="lds-ripple img-fluid" />
    </div>
    <div id="main-wrapper">
        <div class="position-relative overflow-hidden auth-bg min-vh-100 w-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100 my-5 my-xl-0">
                    <div class="col-md-9 d-flex flex-column justify-content-center">
                        <div class="card mb-0 bg-body auth-login m-auto w-auto">
                            <div class="row gx-0">
                                <div class="col-xl-6">
                                    <div class="row justify-content-center py-4">
                                        <div class="col-lg-12">
                                            <div class="card-body">
                                                <a href="../main/index.html" class="text-nowrap logo-img d-block mb-4 w-100">
                                                    <img src="../assets/images/logos/logo.svg" class="dark-logo" alt="Logo-Dark"/>
                                                </a>
                                                <h2 class="lh-base mb-4">Let's get you signed in</h2>
                                                @if ($errors->any())
                                                    <div class="alert alert-danger">
                                                        <ul class="mb-0">
                                                            @foreach ($errors->all() as $error)
                                                                <li class="text-black">{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                                <form method="POST" action="{{ route('login') }}">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="username" class="form-label">Email</label>
                                                        <input type="email" class="form-control" name="username" id="username" placeholder="Masukkan email" aria-describedby="emailHelp">
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <label for="password" class="form-label">Password</label>
                                                            <a class="text-primary link-dark fs-2" href="../main/authentication-forgot-password2.html">Lupa kata sandi ?</a>
                                                        </div>
                                                        <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan kata sandi" aria-describedby="passwordHelp">
                                                    </div>
                                                    <button type="submit" class="btn btn-dark w-100 py-8 mb-4 rounded-1">Masuk</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="dark-transparent sidebartoggler"></div>
    <!-- Import Js Files -->
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/libs/simplebar/dist/simplebar.min.js"></script>
    <script src="../assets/js/theme/app.init.js"></script>
    <script src="../assets/js/theme/theme.js"></script>
    <script src="../assets/js/theme/app.min.js"></script>

    <!-- solar icons -->
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

</html>
