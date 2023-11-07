<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Detail Peminjaman</title>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="/">Politeknik Negeri Bengkalis | D-IV Rekayasa Perangkat Lunak</a>
        </div>
    </nav>
    <div class="container">
        <a href="{{ route('admin.peminjaman') }}">
            <i class="bi-arrow-left h1"></i>
        </a>
        <h5 class="card-title text-center">Detail Peminjaman</h5>
        <div class="row">
            <div class="col-lg-4">
                <div class="card mt-4">
                    <div class="card-body">

                        <input class="form-control mb-3 text-center" type="text"
                            value="ID Peminjaman : {{ $detailPeminjaman->id }}" disabled readonly>
                        <input class="form-control mb-3 text-center" type="text"
                            value="Tanggal Peminjaman : {{ $detailPeminjaman->tanggal_pinjam }}" disabled readonly>
                        <input class="form-control mb-3 text-center" type="text"
                            value="Tanggal Pengembalian : {{ $detailPeminjaman->tanggal_kembali }}" disabled readonly>
                        <input class="form-control mb-3 text-center" type="text"
                            value="Status Pengembalian : {{ $detailPeminjaman->status }}" disabled readonly>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card mt-4">
                    <div class="card-body">
                        <input class="form-control mb-3 text-center" type="text"
                            value="ID Anggota : {{ $detailPeminjaman->id_user }}" disabled readonly>
                        <input class="form-control mb-3 text-center" type="text"
                            value="Nama Anggota : {{ $detailPeminjaman->name }}" disabled readonly>
                        <input class="form-control mb-3 text-center" type="text"
                            value="Email Anggota : {{ $detailPeminjaman->email }}" disabled readonly>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card mt-4">
                    <div class="card-body">
                        <input class="form-control mb-3 text-center" type="text"
                            value="ID Buku : {{ $detailPeminjaman->id_buku }}" disabled readonly>
                        <input class="form-control mb-3 text-center" type="text"
                            value="Kode Buku : {{ $detailPeminjaman->kode_buku }}" disabled readonly>
                        <input class="form-control mb-3 text-center" type="text"
                            value="Judul Buku : {{ $detailPeminjaman->judul_buku }}" disabled readonly>
                        <input class="form-control mb-3 text-center" type="text"
                            value="Penulis : {{ $detailPeminjaman->penulis }}" disabled readonly>
                        <input class="form-control mb-3 text-center" type="text"
                            value="Penerbit : {{ $detailPeminjaman->penerbit }}" disabled readonly>
                        <input class="form-control text-center" type="text"
                            value="Tahun Terbit : {{ $detailPeminjaman->tahun_terbit }}" disabled readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br><br><br>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>