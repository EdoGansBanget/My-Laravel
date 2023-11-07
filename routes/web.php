<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginRegisterController;
use App\Http\Controllers\TentangController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::middleware(['guest'])->group (function (){
Route::get('/', function () {
    return view('home');
    
});


Route::get('/auth/login', [LoginRegisterController::class, 'login'])->name('auth.login');
Route::get('/auth/register', [LoginRegisterController::class, 'register'])->name('auth.register');
});
Route::get('/info/biodata', [TentangController::class, 'biodata'])->name('biodata');
Route::get('home', [TentangController::class, 'home'])->name('home');
Route::get('/user/home', [TentangController::class, 'home'])->name('user.home');
Route::get('/info/berita', [TentangController::class, 'berita'])->name('info.berita');
Route::get('/info/profile', [TentangController::class, 'profile'])->name('info.profile');
Route::get('/info/aktivitas', [TentangController::class, 'aktivitas'])->name('info.aktivitas');


Route::get('/info/dataaktivitas', [TentangController::class, 'dataaktivitas'])->name('info.dataaktivitas');
Route::get('/info/datalulusan', [TentangController::class, 'datalulusan'])->name('info.datalulusan');
Route::get('/info/databerita', [TentangController::class, 'databerita'])->name('info.databerita');


Route::group(['middleware' =>['auth', 'checklevel:user']], function (){
    Route::get('/user/home', [LoginRegisterController::class, 'userHome'])->name('user.home');
});

Route::group(['middleware' =>['auth', 'checklevel:admin']], function (){
    Route::get('/admin/home', [LoginRegisterController::class, 'adminHome'])->name('admin.home');
    Route::get('/admin/tambah', [AdminController::class, 'tambah'])->name('admin.tambah');
    Route::get('/editAdmin/{id}', [AdminController::class, 'editAdmin'])->name('editAdmin');
    Route::get('/deleteAdmin/{id}', [AdminController::class, 'deleteAdmin'])->name('deleteAdmin');
    Route::get('/admin/buku', [AdminController::class, 'adminBuku'])->name('admin.buku');
    Route::get('/admin/tambahBuku', [AdminController::class, 'tambahBuku'])->name('admin.tambahBuku');
    Route::get('/admin/editBuku/{id}', [AdminController::class, 'editBuku'])->name('admin.editBuku');
    Route::get('/admin/deleteBuku/{id}', [AdminController::class, 'deleteBuku'])->name('admin.deleteBuku');
    
    //admin peminjaman
    Route::get('/admin/peminjaman', [AdminController::class, 'adminPeminjaman'])->name('admin.peminjaman');
    Route::get('/admin/tambahpeminjaman', [AdminController::class, 'tambahPeminjaman'])->name('admin.tambahpeminjaman');
    Route::get('/admin/editpeminjaman/{id}', [AdminController::class, 'editPeminjaman'])->name('admin.editpeminjaman');
    Route::get('/admin/deletepeminjaman/{id}', [AdminController::class, 'deletePeminjaman'])->name('admin.deletepeminjaman');
    Route::get('/admin/detailpeminjaman/{id_peminjaman}/{id_user}/{id_buku}', [AdminController::class, 'detailPeminjaman'])->name('admin.detailpeminjaman');
    Route::get('/admin/cetakDataPeminjaman', [AdminController::class, 'cetakDataPeminjaman'])->name('admin.cetakDataPeminjaman');

    //Admin Dosen
    Route::get('/admin/dosen', [AdminController::class, 'adminDosen'])->name('admin.dosen');
    Route::get('/admin/tambahDosen', [AdminController::class, 'tambahDosen'])->name('admin.tambahDosen');
    Route::get('/admin/editDosen/{id}', [AdminController::class, 'editDosen'])->name('admin.editDosen');
    Route::get('/admin/deleteDosen/{id}', [AdminController::class, 'deleteDosen'])->name('admin.deleteDosen');
    
    //end Admin Dosen

    //Route Aktivitas
    Route::get('/admin/aktivitas', [AdminController::class, 'adminAktivitas'])->name('admin.aktivitas');
    Route::get('/admin/tambahAktivitas', [AdminController::class, 'tambahAktivitas'])->name('admin.tambahAktivitas');
    Route::get('/admin/editAktivitas/{id}', [AdminController::class, 'editAktivitas'])->name('admin.editAktivitas');
    Route::get('/admin/deleteAktivitas/{id}', [AdminController::class, 'deleteAktivitas'])->name('admin.deleteAktivitas');
    //End Admin Aktivitas

    //Berita routes
    Route::get('/admin/berita', [AdminController::class, 'adminBerita'])->name('admin.berita');
    Route::get('/admin/tambahBerita', [AdminController::class, 'tambahBerita'])->name('admin.tambahBerita');
    Route::get('/admin/editBerita/{id}', [AdminController::class, 'editBerita'])->name('admin.editBerita');
    Route::get('/admin/deleteBerita/{id}', [AdminController::class, 'deleteBerita'])->name('admin.deleteBerita');

    //end Admin Berita

    //Profile routes
    Route::get('/admin/profile', [AdminController::class, 'adminProfile'])->name('admin.profile');
    Route::get('/admin/tambahProfile', [AdminController::class, 'tambahProfile'])->name('admin.tambahProfile');
    Route::get('/admin/editProfile/{id}', [AdminController::class, 'editProfile'])->name('admin.editProfile');
    Route::get('/admin/deleteProfile/{id}', [AdminController::class, 'deleteProfile'])->name('admin.deleteProfile');

    //End Admin Profile

});
    Route::post('/postTambahBuku', [AdminController::class, 'postTambahBuku'])->name('postTambahBuku');
    Route::post('/postEditBuku/{id}', [AdminController::class, 'postEditBuku'])->name('postEditBuku');

    Route::post('/tambahAdmin', [AdminController::class, 'postTambahAdmin'])->name('postTambahAdmin');
    Route::post('/postEditAdmin/{id}', [AdminController::class, 'postEditAdmin'])->name('postEditAdmin');

    Route::post('/postTambahPeminjaman', [AdminController::class, 'postTambahPeminjaman'])->name('postTambahPeminjaman');
    Route::post('/postEditPeminjaman/{id}', [AdminController::class, 'postEditPeminjaman'])->name('postEditPeminjaman');

    Route::post('/postRegister', [LoginRegisterController::class, 'postRegister'])->name('postRegister');
    Route::post('/postLogin', [LoginRegisterController::class, 'postLogin'])->name('postLogin');
    Route::get('/logout', [LoginRegisterController::class, 'logout'])->name('logout');

    Route::post('/postTambahDosen', [AdminController::class, 'postTambahDosen'])->name('postTambahDosen');
    Route::post('/postEditDosen/{id}', [AdminController::class, 'postEditDosen'])->name('postEditDosen');

    Route::post('/admin/postTambahAktivitas', [AdminController::class, 'postTambahAktivitas'])->name('admin.postTambahAktivitas');
    Route::post('/admin/postEditAktivitas/{id}', [AdminController::class, 'postEditAktivitas'])->name('admin.postEditAktivitas');

    Route::post('/admin/postTambahBerita', [AdminController::class, 'postTambahBerita'])->name('admin.postTambahBerita');
    Route::post('/admin/postEditBerita/{id}', [AdminController::class, 'postEditBerita'])->name('admin.postEditBerita');

    Route::post('/admin/postTambahProfile', [AdminController::class, 'postTambahProfile'])->name('admin.postTambahProfile');
    Route::post('/admin/postEditProfile/{id}', [AdminController::class, 'postEditProfile'])->name('admin.postEditProfile');