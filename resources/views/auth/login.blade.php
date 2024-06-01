<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Feelectric | Coffee + Electric Bicycle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="shortcut icon" href="asset/image/favicon.svg" type="image/x-icon">
    <script src="https://kit.fontawesome.com/18b04d2726.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="asset/css/style.css">
    <script src="asset/js/index.js"></script>
    <style>
        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }

        .google-btn {
            background-color: #ffffff;
            color: #3C2A21;
            border: 1px solid #e0e0e0;
            width: 100%;
        }

        .google-btn:hover {
            background-color: #3C2A21;
            color: #ffffff;
        }

        body,
        html {
            height: 100%;
            /* memastikan body dan html sama dengan tinggi viewport */
            margin: 0;
            padding: 0;
            overflow: hidden;
            color: #3C2A21;
            /* menghilangkan scroll */
        }

        .container-fluid {
            display: flex;
            height: 100vh;
            /* mengatur tinggi sama dengan viewport */
            /* menghilangkan padding */
        }

        .image-form {
            flex: 0 0 600px;
            /* flex basis tanpa grow dan shrink */
            height: 100%;
            /* tinggi penuh */
            margin: 0;
            /* tanpa margin */
        }

        .image-form img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* memastikan gambar menutupi area tanpa distorsi */
        }

        .form-login {
            flex-grow: 1;
            /* mengambil sisa ruang */
            display: flex;
            flex-direction: column;
            /* membuat elemen anak dalam bentuk kolom */
            justify-content: center;
            /* sentralisasi konten */
            padding: 5px;
            /* padding minimal */
        }

        input {
            height: 36px;
        }

        .form-control {
            padding-right: 40px;
            /* Increase right padding to prevent text from covering the icon */
            border: 2px solid #3C2A21;
            border-radius: 0.25rem;
            /* This keeps the corners rounded */
        }

        .form-control-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #3C2A21;
            z-index: 1000;
            /* Ensures the icon stays on top of other elements */
        }

        .input-group-text {
            background: none;
            border: none;
            padding: 0;
        }
    </style>
</head>

<body>
    <div class="container-fluid px-0 d-flex" style="width: 100%; background-color: #FFF7E7;">
        <div class="image-form m-0">
            <img src="{{ asset('frontend/img/login-bg.png') }}" class="object-fit cover"
                style="width: 100%; height: 1000px;">
        </div>
        <div class="form-login py-4" style="flex-grow: 1; margin: 0; padding:160px; width: 462px;">
            <div class="img m-0 p-2 text-center">
                <img src="{{ asset('frontend/img/logo.png') }}" alt="" style="width: 150px;">
            </div>
            <h1 class="text-center fs-3 p-1">Login</h1>
            <p class="text-center " style="line-height: 1; font-size: 15px;">Welcome to Feelectric Coffee Shop! Please
                login to access our exclusive offers and rewards. Let's brew up some great moments together!</p>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group mb-2">
                    <label for="inputEmail" class="form-label float-start">Email</label>
                    <input type="email" id="inputEmail" name="email" class="form-control"
                        placeholder="example@gmail.com" required style="border:2px solid #3C2A21;">
                </div>
                <div class="form-group mb-2">
                    <label for="inputPassword" class="form-label float-start">Password</label>
                    <div class="input-group">
                        <input type="password" id="inputPassword" name="password" class="form-control"
                            placeholder="********" required
                            style="border:2px solid #3C2A21; padding-right: 30px; border-radius: 5px;">
                        <span class="input-group-text">
                            <i class="fa-solid fa-eye form-control-icon"
                                onclick="togglePasswordVisibility('inputPassword')"></i>
                        </span>
                    </div>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-dark"
                        style="width: 100%; background-color: #3C2A21;">Login</button>
                </div>
            </form>


            <div class="text-center mt-2 mb-3 divider">――――――― or login with ―――――――</div>
            <div class="mb-3">
                <a href="/auth/google" class="btn google-btn d-flex align-items-center justify-content-center"
                    style="border:2px solid #3C2A21;">
                    <img src="https://img.icons8.com/color/16/000000/google-logo.png" alt="Google">
                    <span>&nbsp; Google Account</span>
                </a>
            </div>

            <div class="text-center text-decoration-none">
                <p class="m-0">
                    Don't have an account yet?
                </p>
                <a href="{{ route('register') }}" class="text-decoration-none fw-semibold" style="color: #073220;">
                    Register here
                </a>
            </div>
        </div>
    </div>
    </div>

    <script>
        function togglePasswordVisibility(inputId) {
            var input = document.getElementById(inputId);
            var icon = input.parentElement.querySelector('.input-group-text i'); // Memilih ikon di dalam <span>
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash'); // Mengganti ikon mata terbuka menjadi tertutup
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye'); // Mengganti ikon mata tertutup menjadi terbuka
            }
        }
    </script>

</body>

</html>
