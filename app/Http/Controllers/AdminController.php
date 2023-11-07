<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Aktivitas;
use App\Models\Profile;
use App\Models\Buku;
use App\Models\Dosen;
use App\Models\Peminjaman;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Charts\ChartPeminjaman;
use Illuminate\Support\Facades\DB;

use Dompdf\Dompdf;
use Dompdf\Options;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function tambah() {
        return view( 'admin.tambah');
    }

    public function postTambahAdmin(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email:dns',
            'jenisKelamin' => 'required',
            'password' => 'required|min:8|max:20|confirmed'
        ]);

        $user = new User;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->level = 'admin';
        $user->jenis_kelamin = $request->jenisKelamin;
        $user->password = Hash::make($request->password);

        $user->save();

        if($user){
            return back()->with('success', 'Admin baru berhasil ditambah!');
        }
        else {
            return back()->with('failed', 'Gagal menambah admin baru!');
        }
    }

    public function editAdmin($id)
    {
        $data = User::find($id);
        return view('admin.edit', compact('data'));
    }
    public function postEditAdmin(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email:dns',
            'jenisKelamin' => 'required',
        ]);
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->jenis_kelamin = $request->jenisKelamin;
        $user->save();
        if ($user) {
            return back()->with('success', 'Data admin berhasil di update!');
        } else {
            return back()->with('failed', 'Gagal mengupdate data admin!');
        }
    }
    public function deleteAdmin($id)
    {
        $data = User::find($id);
        $data->delete();
        if ($data) {
            return back()->with('success', 'Data berhasil di hapus!');
        } else {
            return back()->with('failed', 'Gagal menghapus data!');
        }
    }

    public function adminBuku(Request $request){
        $search = $request->input('search');
        $data = Buku::where(function($query) use ($search) {
            $query->where('judul_buku', 'LIKE', '%' .$search. '%');
            })->paginate(5);
        return view('admin.buku', compact('data'));
        }
        
    public function tambahBuku()
    {
        return view('admin.tambahBuku');
    }
    public function postTambahBuku(Request $request)
    {
        $request->validate([
            'kodeBuku' => 'required',
            'judulBuku' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahunTerbit' => 'required|date',
            'gambar' => 'required|image|max:5120',
            'deskripsi' => 'required',
            'kategori' => 'required',
        ]);
            $buku = new Buku;
            $buku->kode_buku = $request->kodeBuku;
            $buku->judul_buku = $request->judulBuku;
            $buku->penulis = $request->penulis;
            $buku->penerbit = $request->penerbit;
            $buku->tahun_terbit = $request->tahunTerbit;
            $buku->deskripsi = $request->deskripsi;
            $buku->kategori = $request->kategori;
            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('images/', $filename);
                $buku->gambar = $filename;
        }
        $buku->save();
        if ($buku) {
            return back()->with('success', 'Buku baru berhasil ditambahkan!');
        } else {
            return back()->with('failed', 'Data gagal ditambahkan!');
        }
    }
    public function editBuku($id)
    {
        $data = Buku::find($id);
        return view('admin.editBuku', compact('data'));
    }
    public function postEditBuku(Request $request, $id)
    {
        $request->validate([
            'kodeBuku' => 'required',
            'judulBuku' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahunTerbit' => 'required',
            'gambar' => 'image|max:5120',
            'deskripsi' => 'required',
            'kategori' => 'required'
        ]);

            $buku = Buku::find($id);
            $buku->kode_buku = $request->kodeBuku;
            $buku->judul_buku = $request->judulBuku;
            $buku->penulis = $request->penulis;
            $buku->penerbit = $request->penerbit;
            $buku->tahun_terbit = $request->tahunTerbit;
            $buku->deskripsi = $request->deskripsi;
            $buku->kategori = $request->kategori;

            if ($request->hasFile('gambar')) {
                $filepath = 'images/' . $buku->gambar;
                if (File::exists($filepath)) {
                    File::delete($filepath);
                }
                $file = $request->file('gambar');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('images/', $filename);
                $buku->gambar = $filename;
        }
        $buku->save();
        if ($buku) {
            return back()->with('success', 'Buku berhasil diupdate!');
        } else {
            return back()->with('failed', 'Buku gagal diupdate!');
        }
    }
    public function deleteBuku($id)
    {
        $buku = Buku::find($id);
        $filepath = 'images/' . $buku->gambar;
        if (File::exists($filepath)) {
            File::delete($filepath);
        }
        $buku->delete();
        if ($buku) {
            return back()->with('success', 'Data buku berhasil di hapus!');
        } else {
            return back()->with('failed', 'Gagal menghapus data buku!');
        }
    }
    // PEMINJAMAN
    public function adminPeminjaman(Request $request,  ChartPeminjaman $chartPeminjaman) {
        $search = $request->input('search');
        $chart = $chartPeminjaman->build();
        $data = Peminjaman::where(function($query) use ($search) {
            $query->where('id_user', 'LIKE', '%' .$search. '%');
        })->paginate(5);
            return view('admin.peminjaman', compact('data', 'chart'));
        }
        public function tambahPeminjaman() {
            return view('admin.tambahpeminjaman');
        }
     
        public function postTambahPeminjaman(Request $request) {
        $request->validate([
        'idUser' => 'required',
        'kodeBuku' => 'required|int',
        'tanggalPeminjaman' => 'required|date',
        'tanggalPengembalian' => 'required|date'
        ]);
            $peminjaman = new Peminjaman;
            $peminjaman->id_user = $request->idUser;
            $peminjaman->id_buku = $request->kodeBuku;
            $peminjaman->tanggal_pinjam = $request->tanggalPeminjaman;
            $peminjaman->tanggal_kembali = $request->tanggalPengembalian;
            $peminjaman->status = 'Belum Dikembalikan';
            $peminjaman->save();
            if($peminjaman) {
        return back()->with('success', 'Data peminjaman berhasil 
        ditambahkan!'); 
        } else {
        return back()->with('failed', 'Gagal menambahkan data 
        peminjaman!');
        }
        }
        public function editPeminjaman($id) {
            $data = Peminjaman::find($id);
        return view('admin/editpeminjaman', compact('data'));
        }
        public function postEditPeminjaman(Request $request, $id) {
            $request->validate([
            'idUser' => 'required',
            'kodeBuku' => 'required|int',
            'tanggalPeminjaman' => 'required',
            'tanggalPengembalian' => 'required',
            'status' => 'required'
        ]);
            $peminjaman = Peminjaman::find($id);
            $peminjaman->id_user = $request->idUser;
            $peminjaman->id_buku = $request->kodeBuku;
            $peminjaman->tanggal_pinjam = $request->tanggalPeminjaman;
            $peminjaman->tanggal_kembali = $request->tanggalPengembalian;
            $peminjaman->status = $request->status;
            $peminjaman->save();
            if($peminjaman){
            return back()->with('success', 'Data peminjaman berhasil di update!'); 
            } else {
            return back()->with('failed', 'Gagal mengupdate data peminjaman!');
            }
        }
        public function deletePeminjaman($id) {
            $data = Peminjaman::find($id);
            $data->delete();
            if($data) {
                return back()->with('success', 'Data peminjaman berhasil di hapus!'); 
            } else {
                return back()->with('failed', 'Gagal menghapus data peminjaman!');
            }
        }
         //detail peminjaman
    //detail peminjaman
    public function detailPeminjaman($id_peminjaman, $id_user, $id_buku)
    {
        $detailPeminjaman = Peminjaman::select('peminjaman.*', 'buku.*', 'users.*')
            ->join('buku', 'peminjaman.id_buku', 'buku.id', $id_buku)
            ->join('users', 'peminjaman.id_user', 'users.id', $id_user)
            ->where('peminjaman.id', $id_peminjaman)
            ->first();


        if (!$detailPeminjaman) {
            abort(404, 'Data tidak ditemukan.');
        }

        return view('admin.detailpeminjaman', compact('detailPeminjaman'));
    }

    // Cetak data peminjaman
    public function cetakDataPeminjaman()
    {
        $data = DB::table('peminjaman') // Perhatikan nama tabel 'peminjamen'
            ->join('users', 'users.id', '=', 'peminjaman.id_user')
            ->join('buku', 'buku.id', '=', 'peminjaman.id_buku') // Perhatikan nama tabel 'bukus'
            ->select('peminjaman.*', 'users.name', 'buku.judul_buku') // Perhatikan nama tabel 'peminjamen' dan 'bukus'
            ->get();

        $pdf = PDF::loadView('admin.cetakDataPeminjaman', ['data' => $data]);

        return $pdf->stream();
    }
    // end peminjaman

    //Dosen
    public function adminDosen(Request $request)
    {
        $search = $request->input('search');
        $data = Dosen::where(function($query) use ($search) {
            $query->where('nama', 'LIKE', '%' . $search . '%');
        })->paginate(5);
        return view('admin.dosen', compact('data'));
    }

    public function tambahDosen()
    {
        return view('admin.tambahDosen');
    }

    public function postTambahDosen(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'mataKuliah' => 'required',
            'foto' => 'nullable|image|max:5120',
        ]);

        $dosen = new Dosen;
        $dosen->nama = $request->nama;
        $dosen->mata_kuliah = $request->mataKuliah;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('images/', $filename);
            $dosen->foto = $filename;
        }

        $dosen->save();
        if ($dosen) {
            return back()->with('success', 'Dosen baru berhasil ditambahkan!');
        } else {
            return back()->with('failed', 'Data gagal ditambahkan!');
        }
    }

    public function editDosen($id)
    {
        $data = Dosen::find($id);
        return view('admin.editDosen', compact('data'));
    }

    public function postEditDosen(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'mataKuliah' => 'required',
            'foto' => 'nullable|image|max:5120',
        ]);

        $dosen = Dosen::find($id);
        $dosen->nama = $request->nama;
        $dosen->mata_kuliah = $request->mataKuliah;

        if ($request->hasFile('foto')) {
            $filepath = 'images/' . $dosen->foto;
            if (File::exists($filepath)) {
                File::delete($filepath);
            }
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('images/', $filename);
            $dosen->foto = $filename;
        }

        $dosen->save();
        if ($dosen) {
            return back()->with('success', 'Dosen berhasil diupdate!');
        } else {
            return back()->with('failed', 'Dosen gagal diupdate!');
        }
    }

    public function deleteDosen($id)
    {
        $dosen = Dosen::find($id);
        $filepath = 'images/' . $dosen->foto;
        if (File::exists($filepath)) {
            File::delete($filepath);
        }
        $dosen->delete();
        if ($dosen) {
            return back()->with('success', 'Data dosen berhasil dihapus!');
        } else {
            return back()->with('failed', 'Gagal menghapus data dosen!');
        }
    }
    //end Dosen

    //Aktivitas
    public function adminAktivitas(Request $request)
    {
        $search = $request->input('search');
        $data = Aktivitas::where(function($query) use ($search) {
            $query->where('judul', 'LIKE', '%' . $search . '%');
        })->paginate(5);
        return view('admin.aktivitas', compact('data'));
    }

    public function tambahAktivitas()
    {
        return view('admin.tambahAktivitas');
    }

    public function postTambahAktivitas(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|image|max:5120',
        ]);

        $aktivitas = new Aktivitas;
        $aktivitas->judul = $request->judul;
        $aktivitas->deskripsi = $request->deskripsi;
        $aktivitas->tanggal = $request->tanggal;

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('images/', $filename);
            $aktivitas->gambar = $filename;
        }

        $aktivitas->save();

        if ($aktivitas) {
            return back()->with('success', 'Aktivitas baru berhasil ditambahkan!');
        } else {
            return back()->with('failed', 'Gagal menambahkan aktivitas!');
        }
    }

    public function editAktivitas($id)
    {
        $data = Aktivitas::find($id);
        return view('admin.editAktivitas', compact('data'));
    }

    public function postEditAktivitas(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|image|max:5120',
        ]);

        $aktivitas = Aktivitas::find($id);
        $aktivitas->judul = $request->judul;
        $aktivitas->deskripsi = $request->deskripsi;
        $aktivitas->tanggal = $request->tanggal;

        if ($request->hasFile('gambar')) {
            $filepath = 'images/' . $aktivitas->gambar;
            if (File::exists($filepath)) {
                File::delete($filepath);
            }
            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('images/', $filename);
            $aktivitas->gambar = $filename;
        }

        $aktivitas->save();

        if ($aktivitas) {
            return back()->with('success', 'Aktivitas berhasil diupdate!');
        } else {
            return back()->with('failed', 'Gagal mengupdate aktivitas!');
        }
    }

    public function deleteAktivitas($id)
    {
        $aktivitas = Aktivitas::find($id);
        $filepath = 'images/' . $aktivitas->gambar;
        if (File::exists($filepath)) {
            File::delete($filepath);
        }
        $aktivitas->delete();

        if ($aktivitas) {
            return back()->with('success', 'Data aktivitas berhasil dihapus!');
        } else {
            return back()->with('failed', 'Gagal menghapus data aktivitas!');
        }
    }
    //End Aktivitas

    // Berita

    public function adminBerita(Request $request)
    {
        $search = $request->input('search');
        $data = Berita::where(function($query) use ($search) {
            $query->where('judul', 'LIKE', '%' . $search . '%');
        })->paginate(5);
        return view('admin.berita', compact('data'));
    }

    public function tambahBerita()
    {
        return view('admin.tambahBerita');
    }

    public function postTambahBerita(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|image|max:5120',
        ]);

        $berita = new Berita;
        $berita->judul = $request->judul;
        $berita->deskripsi = $request->deskripsi;
        $berita->tanggal = $request->tanggal;

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('images/', $filename);
            $berita->gambar = $filename;
        }

        $berita->save();

        if ($berita) {
            return back()->with('success', 'Berita baru berhasil ditambahkan!');
        } else {
            return back()->with('failed', 'Gagal menambahkan berita!');
        }
    }

    public function editBerita($id)
    {
        $data = Berita::find($id);
        return view('admin.editBerita', compact('data'));
    }

    public function postEditBerita(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|image|max:5120',
        ]);

        $berita = Berita::find($id);
        $berita->judul = $request->judul;
        $berita->deskripsi = $request->deskripsi;
        $berita->tanggal = $request->tanggal;

        if ($request->hasFile('gambar')) {
            $filepath = 'images/' . $berita->gambar;
            if (File::exists($filepath)) {
                File::delete($filepath);
            }
            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('images/', $filename);
            $berita->gambar = $filename;
        }

        $berita->save();

        if ($berita) {
            return back()->with('success', 'Berita berhasil diupdate!');
        } else {
            return back()->with('failed', 'Gagal mengupdate berita!');
        }
    }

    public function deleteBerita($id)
    {
        $berita = Berita::find($id);
        $filepath = 'images/' . $berita->gambar;
        if (File::exists($filepath)) {
            File::delete($filepath);
        }
        $berita->delete();

        if ($berita) {
            return back()->with('success', 'Data berita berhasil dihapus!');
        } else {
            return back()->with('failed', 'Gagal menghapus data berita!');
        }
    }
    // End Berita

    //Profile
    public function adminProfile(Request $request)
{
    $search = $request->input('search');
    $data = Profile::where(function($query) use ($search) {
        $query->where('nama', 'LIKE', '%' . $search . '%');
    })->paginate(5);
    return view('admin.profile', compact('data'));
}

public function tambahProfile()
{
    return view('admin.tambahProfile');
}

public function postTambahProfile(Request $request)
{
    $request->validate([
        'nama' => 'required',
        'prodi_lulusan' => 'required',
        'gelar' => 'required',
        'tahun_lulus' => 'required|date',
        'foto' => 'nullable|image|max:5120',
    ]);

    $profile = new Profile;
    $profile->nama = $request->nama;
    $profile->prodi_lulusan = $request->prodi_lulusan;
    $profile->gelar = $request->gelar;
    $profile->tahun_lulus = $request->tahun_lulus;

    if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        $file->move('images/', $filename);
        $profile->foto = $filename;
    }

    $profile->save();

    if ($profile) {
        return back()->with('success', 'Profil baru berhasil ditambahkan!');
    } else {
        return back()->with('failed', 'Gagal menambahkan profil!');
    }
}
public function editProfile($id)
{
    $data = Profile::find($id);
    return view('admin.editProfile', compact('data'));
}

public function postEditProfile(Request $request, $id)
{
    $request->validate([
        'nama' => 'required',
        'prodi_lulusan' => 'required',
        'gelar' => 'required',
        'tahun_lulus' => 'required|date',
        'foto' => 'nullable|image|max:5120',
    ]);

    $profile = Profile::find($id);
    $profile->nama = $request->nama;
    $profile->prodi_lulusan = $request->prodi_lulusan;
    $profile->gelar = $request->gelar;
    $profile->tahun_lulus = $request->tahun_lulus;

    if ($request->hasFile('foto')) {
        $filepath = 'images/' . $profile->foto;
        if (File::exists($filepath)) {
            File::delete($filepath);
        }
        $file = $request->file('foto');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        $file->move('images/', $filename);
        $profile->foto = $filename;
    }

    $profile->save();

    if ($profile) {
        return back()->with('success', 'Profile berhasil diupdate!');
    } else {
        return back()->with('failed', 'Gagal mengupdate profile!');
    }
}

public function deleteProfile($id)
{
    $profile = Profile::find($id);
    $filepath = 'images/' . $profile->foto;
    if (File::exists($filepath)) {
        File::delete($filepath);
    }
    $profile->delete();

    if ($profile) {
        return back()->with('success', 'Data profile berhasil dihapus!');
    } else {
        return back()->with('failed', 'Gagal menghapus data profile!');
    }
}
    //end profile

}