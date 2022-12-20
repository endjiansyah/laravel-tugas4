<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Far Capital</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css"
        integrity="sha512-SbiR/eusphKoMVVXysTKG/7VseWii+Y3FdHrt0EpKgpToZeemhqHeZeLWLhJutz/2ut2Vw1uQEj2MbRF+TVBUA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    {{-- ------------ --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">
            <a class="navbar-brand" href="#">HILIH</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="d-flex justify-content-between w-100">


                    <div class="navbar-nav">
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
                        <a class="nav-link" href="/article">Article</a>
                        <a class="nav-link" href="/produk">Produk</a>
                    </div>
                    <div class="row">
                        <h5 class="col text-light my-auto">{{ session()->get('siapahayo') }}</h5>
                        @if (session()->get('logged', false))
                            <a href="{{ route('logout') }}" class="btn btn-danger col py-auto">Logout</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-light">Login</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </nav>
    {{-- ------------- --}}
    <div class="container py-5">
        @if ($message = Session::get('success'))
            <div class="alert alert-success mb-1" role="alert">{{ $message }}</div>
        @endif
        @if ($message = Session::get('hapus'))
            <div class="alert alert-danger mb-1" role="alert">{{ $message }}</div>
        @endif

        @yield('content')

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js"
        integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.6.2.min.js"
        integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>

    @yield('script')
</body>

</html>
