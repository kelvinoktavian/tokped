<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- <title>{{ config('app.name', 'tokped') }} | {{ $title }}</title> --}}
    <title>Souvenir BOSS | {{ $title }}</title>
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="{{ asset('bootstrap-icon/font/bootstrap-icons.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    {{-- <script src="https://unpkg.com/axios/dist/axios.min.js"></script> --}}
    <script src="{{ asset('axios.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/jpg" href="{{ asset('images/img/logo.png') }}" />
</head>

<body>
    <div id="app">
        @include('partials.navbar')

        <main>
            <div class="my-5 container">
                @yield('content')
            </div>
        </main>

        @include('partials.footer')
    </div>
    <!-- jQuery -->
    {{-- <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script> --}}
    <script src="{{ asset('jquery.js') }}"></script>

    {{-- SweetAlert 2 --}}
    <script src="{{ asset('sweetalert2/dist/sweetalert2.all.min.js') }}"></script>

    {{-- My JS --}}
    <script src="{{ asset('assets/js/script.js') }}"></script>

    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- bs-custom-file-input -->
    <script src="{{ asset('adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

    <!-- AdminLTE App -->
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>

    <script>
        const qty = document.querySelectorAll('.qty');
        
        Array.from(qty).forEach(function(e) {
            e.addEventListener('change', function() {
                const id = e.getAttribute('data-id');
                const price = e.getAttribute('data-price');
                
                axios.patch(`/cart/${id}`, {
                    qty: this.value,
                    total_price: this.value * price
                })
                // kalo sukses
                .then(function (response) {
                    console.log(response);
                    // refresh page
                    window.location.href = '/cart';
                })
                // kalo gagal
                .catch(function (error) {
                    console.log(error);
                });
            }); 
        }); 
    </script>
</body>

</html>