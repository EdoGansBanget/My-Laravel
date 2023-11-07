<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Tambah Data Profile</title>
</head>

<body>

    <div class="container">
        <a href="{{ route('admin.profile') }}">
            <i class="bi-arrow-left h1"></i>
        </a>
        <div class="container mt-3">
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
        </div>
        <div class="row">
            <div class="col d-flex justify-content-center">
                <div class="card mt-4" style="width: 800px">
                    <div class="card-body">
                        <h5 class="card-title text-center">Tambah Data Profile</h5>
                        <form action="{{ route('admin.postTambahProfile') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mt-4">
                                <label class="text-secondary mb-2">Nama</label>
                                <input type="text" class="form-control border border-secondary form-control" name="nama"
                                    required value="{{ old('nama') }}">
                                <span class="text-danger">
                                    @error('nama')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div><br>
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Prodi Lulusan</label>
                                <input type="text" class="form-control border border-secondary form-control"
                                    name="prodi_lulusan" required value="{{ old('prodi_lulusan') }}">
                                <span class="text-danger">
                                    @error('prodi_lulusan')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Gelar</label>
                                <input type="text" class="form-control border border-secondary form-control"
                                    name="gelar" required value="{{ old('gelar') }}">
                                <span class="text-danger">
                                    @error('gelar')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div><br>
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Tahun Lulus</label>
                                <input type="date" class="form-control border border-secondary form-control"
                                    name="tahun_lulus" required value="{{ old('tahun_lulus') }}">
                                <span class="text-danger">
                                    @error('tahun_lulus')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div><br>
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Foto Profile</label>
                                <input type="file" class="form-control border border-secondary form-control"
                                    name="foto">
                                <span class="text-danger">
                                    @error('foto')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <button type="submit" class="btn btn-success mt-5">Tambah Data Profile</button>
                        </form>
                    </div>
                </div>
            </div>
        </div><br><br><br><br>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>