<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - Feelectric | Coffee + Electric Bicycle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        crossorigin="anonymous"/>
    <link rel="shortcut icon" href="asset/image/favicon.svg" type="image/x-icon">
    <script src="https://kit.fontawesome.com/18b04d2726.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="asset/css/style.css">
    <script src="asset/js/index.js"></script>
    <style>
        body,
        html {
            height: 100vh;
            /* memastikan body dan html sama dengan tinggi viewport */
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            color: #3C2A21;
        }

        .container-fluid {
            display: block;
        }

        .image-form {
            flex: 0 0 600px;
            /* flex basis tanpa grow dan shrink */
            height: 700px;
            overflow: hidden; /* Hindari gambar yang keluar dari batas container */
        }

        .image-form img {
            width: 100%;
            height: auto; /* Biarkan gambar menyesuaikan ukuran lebar container */
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
            padding: 30px 50px 30px 50px; /* Tambahkan padding untuk memisahkan konten dari tepi layar */
        }

        .form-container {
            max-width: 400px; /* Atur lebar maksimum form */
            margin: auto;
            width: 100%;
        }

        input {
            height: 36px;
        }

        .form-group {
            position: relative;
        }

        .form-control {
            padding-right: 40px;
            /* Increase right padding to prevent text from covering the icon */
            border: 2px solid #3C2A21;
        }

        .form-control-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #3C2A21;
            z-index: 2;
            /* Ensures the icon stays on top of other elements */
        }

        @media (max-width: 768px) {
            .image-form {
                display: none; /* Sembunyikan gambar pada layar 768px atau lebih kecil */
            }

            .form-login {
                padding: 20px; /* Sesuaikan padding untuk layar kecil */
            }
        }

    </style>
</head>

<body>
    <div class="container-fluid px-0 d-flex" style="background-color: #FFF7E7;">
        <div class="image-form">
            <img src="{{ asset('frontend/img/login-bg.png') }}" class="object-fit cover">
        </div>
        <div class="form-login py-4" style="flex-grow: 1;">
            <div class="form-container">
            <div class="img text-center">
                <img src="{{ asset('frontend/img/logo.png') }}" alt="" style="width: 150px;">
            </div>
            <h1 class="text-center fs-3 p-1">Daftar</h1>
            <p class="text-center " style="line-height: 1; font-size: 15px;">Welcome to Feelectric Coffee Shop! To unlock exclusive offers and rewards, please register an account. Let's brew up some great moments together!</p>
            <form action="{{ route('register') }}" method="POST">
                @csrf

                {{-- Default Role --}}
                <input type="hidden" name="role" value="user">

                {{-- Nama Lengkap --}}
                <div class="form-group mb-1">
                    <label for="inputName" class="form-label float-start">Full Name</label>
                    <input type="text" id="inputName" name="name" class="form-control" placeholder="Full Name"
                        required>
                </div>

                {{-- Username --}}
                <div class="form-group mb-1">
                    <label for="inputUsername" class="form-label float-start">Username</label>
                    <input type="text" id="inputUsername" name="username" class="form-control"
                    placeholder="Username" required>
                </div>
                    
                {{-- Email --}}
                <div class="form-group mb-1">
                    <label for="inputEmail" class="form-label float-start">Email</label>
                    <input type="email" id="inputEmail" name="email" class="form-control"
                    placeholder="example@gmail.com" required>
                </div>
                

                {{-- Password --}}
                <div class="form-group mb-1 position-relative">
                    <label for="inputPassword" class="form-label float-start">Password</label>
                    <input type="password" id="inputPassword" name="password" class="form-control"
                            placeholder="Password" required>
                    <i class="fas fa-eye form-control-icon" style="right: 10px; padding-top: 30px;" onclick="togglePasswordVisibility('inputPassword')"></i>
                </div>

                {{-- Konfirmasi Password --}}
                <div class="form-group mb-2  position-relative">
                    <label for="inputPasswordConfirmation" class="form-label float-start">Confirm Password</label>
                        <input type="password" id="inputPasswordConfirmation" name="password_confirmation"
                            class="form-control" placeholder="Confirm Password" required>
                        <i class="fas fa-eye form-control-icon" style="right: 10px; padding-top: 30px;" onclick="togglePasswordVisibility('inputPasswordConfirmation')"></i>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-dark" style="width: 100%; background-color: #3C2A21;">
                        Daftar
                    </button>
                </div>
            </form>

            <div class="text-center">
                <p>
                    Sudah memiliki akun?
                </p>
                <a href="{{ route('login') }}" class="text-decoration-none fw-semibold" style="color: #073220;">
                    Login disini
                </a>
            </div>
        </div>
    </div>
    </div>

    <script>
        function togglePasswordVisibility(inputId) {
            var input = document.getElementById(inputId);
            var icon = input.nextElementSibling;  // Assuming the icon is next to the input
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>

</body>

</html>
