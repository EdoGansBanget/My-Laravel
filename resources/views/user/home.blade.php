<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Homepage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <div style="display: flex; align-items: center;">
                    <img src="{{ asset('image/POLBENG.PNG') }}" style="max-height: 30px; margin-top: -1px;"
                        loading="lazy" />
                    <span style="margin-left: 5px;">Politeknik Negeri Bengkalis | D-IV Rekayasa Perangkat Lunak</span>
                </div>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarButtonsExample" aria-controls="navbarButtonsExample" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarButtonsExample">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('info.berita') }}">Berita RPL</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('info.aktivitas') }}">Aktivitas RPL</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('info.profile') }}">Profile Lulusan RPL</a>
                    </li>
                </ul>
            </div>

            <div style="display: flex; justify-content: flex-start;">
                <div class="dropdown ms-auto">
                    <div class="btn-group">
                        <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img src="{{ asset('image/profile.png') }}" class="rounded-circle" width="40">
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <div class="container" style="width: 18rem;">
                                    <img src="{{ asset('image/profile.png') }}" class="card-img-top rounded-circle"
                                        style="width: 50;">
                                    <div class="card-body">
                                        <h5 class="card-title">{{Auth::user()->name }}</h5>
                                        <p class="card-text">Saya adalah User</p>
                                    </div>
                                    <br><br>
                                    <div class="card-body">
                                        <a href="{{ route('logout') }}" class="text-decoration-none ms-2">
                                            <button type="button" class="btn btn-danger btn-sm">
                                                Logout
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- Navbar -->
    <br><br>

    <div class="row mt-5 mb-5">
        <div class="col"></div>
        <div class="col-6">
            <form action="" method="GET">
                @csrf
                <div class="input-group">
                    <input type="search" name="search" class="form-control rounded" placeholder="Cari nama buku"
                        aria-label="Search" aria-describedby="search-addon" />
                    <button type="submit" class="btn btn-outline-primary">search</button>
                </div>
            </form>
        </div>
        <div class="col"></div>
    </div>
    <div class="container">
        @foreach ($data as $buku)
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-2"><img style="width: 150px" src="{{ asset('images/' . $buku->gambar) }}"
                            alt="cover buku"></div>
                    <div class="col-2">
                        <p class="fw-bold">Judul</p>
                        <p class="fw-bold">Penulis</p>
                        <p class="fw-bold">Penerbit</p>
                        <p class="fw-bold">Tahun Terbit</p>
                        <p class="fw-bold">Deskripsi Buku</p>
                    </div>
                    <div class="col-8">
                        <p>{{ $buku->judul_buku }}</p>
                        <p>{{ $buku->penulis }}</p>
                        <p>{{ $buku->penerbit }}</p>
                        <p>{{ $buku->tahun_terbit }}</p>
                        <p>{{ $buku->deskripsi }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        {{ $data->links() }}
    </div>
    <!-- Footer section -->
    <div class="bg-dark text-white mt-5">
        <div class="container p-4 text-center">
            Copyright 2023 @Atthoillah Corporation
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js">
    </script>
</body>

</html>