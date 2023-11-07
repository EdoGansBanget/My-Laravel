<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <title>Peminjaman</title>
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
        <div class="container mt-3">
            @if (Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil!</strong> {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if (Session::get('failed'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal!</strong> {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
        </div>
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-center">
                    {!! $chart->container() !!}
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col"></div>
            <div class="col-6">
                <form action="{{ route('admin.peminjaman') }}" method="GET">
                    @csrf
                    <div class="input-group">
                        <input type="search" name="search" class="form-control rounded" placeholder="Cari id peminjam"
                            aria-label="Search" aria-describedby="search-addon" />
                        <button type="submit" class="btn btn-outline-primary"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
            <div class="col"></div>
        </div>
        <div class="row mt-5">
            <div class="col"><a class="btn btn-info text-white" target="_blank"
                    href="{{ route('admin.cetakDataPeminjaman') }}" style="text-decoration: none; margin-right: 30px"><i
                        class="fas fa-print"></i><span>Cetak Data</span></a></div>
            <div class="col"></div>
            <div class="col-2">
                <a class="btn btn-success" href="{{route('admin.tambahpeminjaman') }}"
                    style="text-decoration: none; margin-left: 30px">Tambah
                    Data <i class="fas fa-plus"></i></a>
            </div>
        </div>
        <table class="table" style="margin-top: 10px">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nomor Anggota</th>
                    <th scope="col">Kode Buku</th>
                    <th scope="col">Tanggal Peminjaman</th>
                    <th scope="col">Tanggal Pengembalian</th>
                    <th scope="col">Status Peminjaman</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($data as $index => $peminjam)
                <tr>
                    <td scope="row">{{ $index + $data->firstItem() }}</td>
                    <td>{{ $peminjam->id_user }}</td>
                    <td>{{ $peminjam->id_buku }}</td>
                    <td>{{ $peminjam->tanggal_pinjam }}</td>
                    <td>{{ $peminjam->tanggal_kembali }}</td>
                    <td>
                        <span
                            class="{{ $peminjam->status === 'Sudah Dikembalikan' ? 'fw-semibold text-success' : 'fw-semibold text-danger'}}">
                            {{ $peminjam->status }}
                        </span>
                    </td>
                    <td>
                        <a class="btn btn-outline-primary"
                            href="/admin/detailpeminjaman/{{$peminjam->id }}/{{ $peminjam->id_user }}/{{ $peminjam->id_buku}}"><i
                                class="fas fa-info"></i></a>
                        <a class="btn btn-outline-warning" href="/admin/editpeminjaman/{{ $peminjam->id }}"><i
                                class="fas fa-pen"></i></a>
                        <a class="btn btn-outline-danger" href="/admin/deletepeminjaman/{{$peminjam->id }}"><i
                                class="fas fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table><br>
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
    <script src="{{ $chart->cdn() }}"></script>
    {{ $chart->script() }}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>