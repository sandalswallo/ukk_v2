<?php

use Illuminate\Support\Facades\Route;
use PharIo\Manifest\AuthorCollection;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\{
  DashboardController,
  OutletController,
  PaketController,
  BendaController,
  Jenis_PaketController,
  LayananController,
  BeratController,
  MemberController,
  TransaksiController,
  Detail_TransaksiController,
  UserController
};


Route::get('/', function () {
  return view('home.welcome');
});


Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/postlogin', [AuthController::class, 'postlogin'])->name('postlogin');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/postregister', [AuthController::class, 'postregister'])->name('postregister');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth', 'checkRole:admin'], function () {
  Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

  Route::get('/outlet/data', [OutletController::class, 'data'])->name('outlet.data');
  Route::resource('/outlet', OutletController::class);

  Route::get('/paket/data', [PaketController::class, 'data'])->name('paket.data');
  Route::resource('/paket', PaketController::class);

  Route::get('/benda/data', [BendaController::class, 'data'])->name('benda.data');
  Route::resource('/benda', BendaController::class);

  Route::get('/jenis_paket/data', [Jenis_PaketController::class, 'data'])->name('jenis_paket.data');
  Route::resource('/jenis_paket', Jenis_PaketController::class);

  Route::get('/layanan/data', [LayananController::class, 'data'])->name('layanan.data');
  Route::resource('/layanan', LayananController::class);

  Route::get('/berat/data', [BeratController::class, 'data'])->name('berat.data');
  Route::resource('/berat', BeratController::class);

  Route::get('/member/data', [MemberController::class, 'data'])->name('member.data');
  Route::resource('/member', MemberController::class);

  Route::get('/transaksi/data', [TransaksiController::class, 'data'])->name('transaksi.data');
  Route::resource('/transaksi', TransaksiController::class);

  Route::get('/detail_transaksi/data', [Detail_TransaksiController::class, 'data'])->name('detail_transaksi.data');
  Route::resource('/detail_transaksi', Detail_TransaksiController::class);

  Route::get('/user/data', [UserController::class, 'data'])->name('user.data');
  Route::resource('/user', UserController::class);
  Route::get('/user/{id}/profile', [UserController::class, 'profile'])->name('user.profile');
  // Route::post('/profile/{id}', [UserController::class, 'update'])->name('profile.update');
});
