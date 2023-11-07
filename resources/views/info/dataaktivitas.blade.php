<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <title>Homepage</title>
</head>
<body>
    <div class="container mt-5">
        <h3 class="text-center">Tambah Data Aktivitas</h3>
            <form>
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" class="form-control" id="judul" placeholder="Masukkan judul">
                </div>
                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <textarea class="form-control" id="keterangan" rows="3" placeholder="Masukkan keterangan"></textarea>
                </div>
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal">
                </div>
                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar</label>
                    <input type="file" class="form-control" id="gambar">
                </div>
                <div class="mb-3">
                    <a class = " pb-2" href="{{ route('admin.home') }}">
                        <button type="button" class="btn btn-danger btn-sm">
                            Kembali
                        </button>
                    </a>
                    <a class = " pb-2" href="#">
                        <button type="submit" class="btn btn-primary btn-sm">
                            Simpan
                        </button>
                    </a>
                </div>
            </form>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js">
    </script>
</body>
</html>