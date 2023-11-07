<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <title>Homepage</title>
</head>
<link rel="stylesheet" href="style.css">

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <!-- Container wrapper -->
        <div class="container">
            <!-- Navbar brand -->
            <a class="navbar-brand">
                <div style="display: flex; align-items: center;">
                    <img src="{{ asset('image/POLBENG.PNG') }}" style="max-height: 30px; margin-top: -1px;"
                        loading="lazy" />
                    <span style="margin-left: 5px;">Politeknik Negeri Bengkalis | D-IV Rekayasa Perangkat Lunak</span>
                </div>

            </a>

            <!-- Toggle button -->
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse"
                data-mdb-target="#navbarButtonsExample" aria-controls="navbarButtonsExample" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <div class="d-flex align-items-center">
                <!-- Collapsible wrapper -->
                <div class="collapse navbar-collapse" id="navbarButtonsExample">
                    <!-- Left links -->
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('auth.login') }}">Berita RPL</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('auth.login') }}">Aktivitas RPL</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('auth.login') }}">Profile Lulusan RPL</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('biodata') }}">Biodata</a>
                        </li>

                    </ul>
                    </a>
                </div>
            </div>

        </div>
        <div style="display: flex; justify-content: flex-start;">
            <a href="{{ route('auth.login') }}" class="btn btn-link px-3 me-2"
                style="color: black; text-decoration: none;">
                Login
            </a>
            <a href="{{ route('auth.register') }}" class="btn btn-primary px-3 me-2" style="text-decoration: none;">
                Sign Up
            </a>
        </div>
        <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
    <br><br>
    <div class="bg-image" style="background-image: url('{{ asset('image/library.jpg') }}'); height: 100vh;">
        <div class="container">
            <div class="row">

                <div class="col-12 text-center text-white">
                    <br>
                    <h1 class="text-secondary">
                        Selamat Datang!
                    </h1>
                    <h4 class="text-secondary">
                        Di Perpustakaan Politeknik Negeri Bengkalis
                    </h4>
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <footer class="footer bg-dark text-white text-center py-2 fixed-bottom">
        <p>Copyright 2023 @Atthoillah Corporation</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>