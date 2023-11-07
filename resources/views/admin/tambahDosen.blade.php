<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Tambah Data Dosen</title>
</head>

<body>

    <div class="container">
        <a href="{{ route('admin.dosen') }}">
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
                        <h5 class="card-title text-center">Tambah Data Dosen</h5>
                        <form action="{{ route('postTambahDosen') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mt-4">
                                <label class="text-secondary mb-2">Nama Dosen</label>
                                <input type="text" class="form-control border border-secondary form-control" name="nama"
                                    required value="{{ old('nama') }}">
                                <span class="text-danger">
                                    @error('nama')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div><br>
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Mata Kuliah</label>
                                <input type="text" class="form-control border border-secondary form-control"
                                    name="mataKuliah" required value="{{ old('mataKuliah') }}">
                                <span class="text-danger">
                                    @error('mataKuliah')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div><br>
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Foto Dosen</label>
                                <input type="file" class="form-control border border-secondary form-control"
                                    name="foto">
                                <span class="text-danger">
                                    @error('foto')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <button type="submit" class="btn btn-success mt-5">Tambah Data Dosen</button>
                        </form>
                    </div>
                </div>
            </div>
        </div><br><br><br><br>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>