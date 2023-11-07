<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <title>Daftar Buku</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <style>
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        overflow-x: hidden;
    }

    /*navbar*/

    .sidebar h2 {

        margin: 0;
        text-align: center;
        display: block;
    }

    .sidebar h2 i {
        display: block;
    }

    .sidebar a {
        color: #fff;
        text-decoration: none;
        display: flex;
        align-items: center;
        padding: 10px;
    }

    .sidebar a i {
        margin-right: 10px;
    }

    .sidebar a span {
        display: block;
    }

    .main-content {
        margin-left: 250px;

        transition: all 0.3s ease;
        position: relative;
        background-color: #fff;
        /* Latar belakang putih */
        padding-left: 20px;
        /* Sama dengan padding sidebar saat ditutup */
    }

    .main-content.active {
        margin-left: 70px;
        /* Lebar sidebar saat ditutup */
        background-color: #f9f9f9;
        padding-left: 20px;
        /* Margin kiri saat sidebar ditutup */
    }

    .sidebar.active {
        width: 70px;
        /* Lebar sidebar saat ditutup */
    }

    .sidebar.active .sidebar-toggle {
        left: 50px;
        /* Posisi tombol sidebar saat ditutup */
    }

    .sidebar.active a span {
        display: none;
    }

    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        width: 250px;
        background-color: #2ecc71;
        /* Warna hijau */
        color: #fff;
        transition: all 0.3s ease;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        /* Menjadikan elemen child berada dalam kolom */
    }

    .sidebar .sidebar-toggle {
        align-self: flex-end;
        /* Posisi ikon ke kiri */
        margin: 10px;
        margin-right: 7mm;
    }

    .sidebar-toggle i {
        font-size: 20px;
    }

    .menu {
        display: grid;

        grid-column-gap: 3mm;
        align-items: center;
        text-decoration: none;
        margin-bottom: 10px;
    }

    .menu i {
        margin-left: 5mm;
        margin-right: 5mm;
    }
    </style>
</head>

<body>
    <div class="sidebar" id="sidebar">
        <span class="sidebar-toggle" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </span>
        <a href="{{ route('admin.home') }}" class="menu">
            <i class="fas fa-window-maximize"></i>
            <span>Home</span>
        </a>

        <a href="{{ route('admin.buku') }}" class="menu">
            <i class="fas fa-book"></i>
            <span>Data Buku</span>
        </a>

        <a href="{{ route('admin.peminjaman') }}" class="menu">
            <i class="fas fa-handshake"></i>
            <span>Data Peminjaman</span>
        </a>
        <a href="{{ route('admin.dosen') }}" class="menu">
            <i class="fas fa-user"></i>
            <span>Data Dosen</span>
        </a>
        <a href="{{ route('admin.berita') }}" class="menu">
            <i class="fas fa-newspaper"></i>
            <span>Data Berita</span>
        </a>
        <a href="{{ route('admin.profile') }}" class="menu">
            <i class="fas fa-users"></i>
            <span>Data Profile Lulusan</span>
        </a>
        <a href="{{ route('admin.aktivitas') }}" class="menu">
            <i class="fas fa-list"></i>
            <span>Data Aktivitas</span>
        </a>
        <a href="{{ route('logout') }}" class="text-decoration-none mt-auto">
            <button type="button" class="btn btn-danger btn-sm text-end">
                Logout
            </button>
        </a>
    </div>

    <!-- Main Content -->
    <div class="main-content" id="main-content">
        <div class="container mt-4">
            <div class="row mt-3">
                <div class="col">
                    <form action="{{ route('admin.buku') }}" method="GET">
                        @csrf
                        <div class="input-group">
                            <input type="search" name="search" class="form-control rounded"
                                placeholder="Cari judul buku" aria-label="Search" aria-describedby="search-addon" />
                            <button type="submit" class="btn btn-outline-primary"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>
                <div class="col text-end">
                    <a class="btn btn-success" href="{{ route('admin.tambahBuku') }}"
                        style="text-decoration: none;">Tambah
                        Data <i class="fas fa-plus"></i></a>
                </div>
            </div>
        </div>
        <div class="container mt-4">
            @if (Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil!</strong> {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if (Session::get('failed'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal!</strong> {{ Session::get('failed') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <!-- Existing HTML structure -->
            <!-- ... -->

            <table class="table mt-4">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Kode Buku</th>
                        <th scope="col">Judul Buku</th>
                        <th scope="col">Penulis</th>
                        <th scope="col">Penerbit</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Tahun Terbit</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($data as $index => $buku)
                    <tr>
                        <td scope="row">{{ $index + $data->firstItem() }}</td>
                        <td>
                            <img style="width: 50px" src="{{ asset('/images/' . $buku->gambar) }}" alt="gambar buku">
                        </td>
                        <td>{{ $buku->kode_buku }}</td>
                        <td>{{ $buku->judul_buku }}</td>
                        <td>{{ $buku->penulis }}</td>
                        <td>{{ $buku->penerbit }}</td>
                        <td>{{ $buku->kategori }}</td>
                        <td>{{ $buku->deskripsi }}</td>
                        <td>{{ $buku->tahun_terbit }}</td>
                        <td>
                            <a class="btn btn-outline-warning" href="{{ route('admin.editBuku', $buku->id) }}"><i
                                    class="fas fa-pen"></i></a>
                            <a class="btn btn-outline-danger" href="{{ route('admin.deleteBuku', $buku->id) }}"><i
                                    class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Remaining HTML code -->
            <!-- ... -->

            {{ $data->links() }}
        </div>
    </div>
    <script>
    const sidebar = document.getElementById("sidebar");
    const mainContent = document.getElementById("main-content");

    function toggleSidebar() {
        sidebar.classList.toggle("active");
        mainContent.classList.toggle("active");
    }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>