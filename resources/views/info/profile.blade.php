<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous" />
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
                        <a class="nav-link" href="{{ route('user.home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('info.berita') }}">Berita RPL</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('info.aktivitas') }}">Aktivitas RPL</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Profile Lulusan RPL</a>
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
    <div class="container mt-5">
        <img class="rounded-4" style="object-fit : cover; width: 100%; height: 400px"
            src="{{ asset('image/polbeng.jpg') }}" alt="" />
    </div>

    <!-- this is list news section -->
    <div class="container mt-5">
        <h3>Profile Lulusan Rekayasa Perangkat Lunak Politeknik Negeri Bengkalis</h3>
        <div class="row">
            <div class="row">
                @foreach ($data as $profile)
                <div class="col-3">
                    <img class="rounded-4" style="object-fit: cover; width: 100%; aspect-ratio: 1/1"
                        src="{{ asset('/images/' . $profile->foto) }}" alt="Foto Profil" />
                    <p class="mt-3">
                        <b>{{ $profile->nama }} | {{ $profile->prodi_lulusan }}</b> <br />
                        Gelar: {{ $profile->gelar }} <br />
                        Tahun Lulus: {{ $profile->tahun_lulus }}
                    </p>
                </div>
                @endforeach
            </div>

        </div>
    </div>
    <!-- this is footer section -->
    <div class="bg-dark text-white mt-5">
        <div class="container p-4 text-center">
            Copyright 2023 @Atthoillah Corporation
        </div>
    </div>

    <!-- source javascript is needed to make dynamic components work using a javascript language imported from outside -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
</body>

</html>