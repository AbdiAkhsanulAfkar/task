<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\GedungController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\PenyediaController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [HomeController::class, 'home']);
	Route::get('dashboard', function () {
		if (auth()->user()->role == 'admin') {
			session()->regenerate();
			$admin = User::where('role','admin')->count();
			$penyedia = User::where('role','penyedia')->count();
			$user= User::where('role','user')->count();
			$gedung= DB::table('gedung')->count();
			return view('dashboard', compact('admin','penyedia','user', 'gedung'));
		}else{
			session()->regenerate();
			$users = User::count();
			return view('welcome', compact('users'))->with(['success'=>'You are logged in.']);
		}
	})->name('dashboard');

	
	Route::get('/penyedia', [PenyediaController::class, 'dataPenyedia'])->name('penyedia');
	Route::get('/penyedia/tambah', [PenyediaController::class, 'viewTambahPenyedia'])->name('tambah_penyedia');
	Route::post('/penyedia/tambah', [PenyediaController::class, 'tambahDataPenyedia'])->name('post_penyedia');
	Route::get('/penyedia/hapus/{id}',[PenyediaController::class, 'hapusDataPenyedia'])->name('hapus_penyedia');
	Route::get('/penyedia/edit/{id}/',[PenyediaController::class, 'editDataPenyedia'])->name('edit_penyedia');
	Route::post('/penyedia/edit', [PenyediaController::class, 'postEditPenyedia'])->name('post_edit_penyedia');
	
	Route::get('/admin', [AdminController::class, 'dataAdmin'])->name('admin');
	Route::get('/admin/tambah', [AdminController::class, 'viewTambahAdmin'])->name('tambah_admin');
	Route::post('/admin/tambah', [AdminController::class, 'tambahDataAdmin'])->name('post_admin');
	Route::get('/admin/hapus/{id}',[AdminController::class, 'hapusDataAdmin'])->name('hapus_admin');
	Route::get('/admin/edit/{id}/',[AdminController::class, 'editDataAdmin'])->name('edit_admin');
	Route::post('/admin/edit', [AdminController::class, 'postEditAdmin'])->name('post_edit_admin');

	Route::get('/user', [UserController::class, 'dataUser'])->name('user');
	Route::get('/user/tambah', [UserController::class, 'viewTambahUser'])->name('tambah_user');
	Route::post('/user/tambah', [UserController::class, 'tambahDataUser'])->name('post_user');
	Route::get('/user/hapus/{id}',[UserController::class, 'hapusDataUser'])->name('hapus_user');
	Route::get('/user/edit/{id}/',[UserController::class, 'editDataUser'])->name('edit_user');
	Route::post('/user/edit', [UserController::class, 'postEditUser'])->name('post_edit_user');

	Route::get('/gedung', [GedungController::class, 'dataGedung'])->name('gedung');
	Route::get('/gedung/tambah', [GedungController::class, 'viewTambahGedung'])->name('tambah_gedung');
	Route::post('/gedung/tambah', [GedungController::class, 'tambahDataGedung'])->name('post_gedung');
	Route::get('/gedung/hapus/{id}',[GedungController::class, 'hapusDataGedung'])->name('hapus_gedung');
	Route::get('/gedung/edit/{id}/',[GedungController::class, 'editDataGedung'])->name('edit_gedung');
	Route::post('/gedung/edit', [GedungController::class, 'postEditGedung'])->name('post_edit_gedung');

	Route::get('tables', function () {
		return view('tables');
	})->name('tables');

    Route::get('virtual-reality', function () {
		return view('virtual-reality');
	})->name('virtual-reality');

    Route::get('static-sign-in', function () {
		return view('static-sign-in');
	})->name('sign-in');

    Route::get('static-sign-up', function () {
		return view('static-sign-up');
	})->name('sign-up');

    Route::get('/logout', [SessionsController::class, 'destroy']);
	Route::get('/user-profile', [InfoUserController::class, 'create']);
	Route::post('/user-profile', [InfoUserController::class, 'store']);
    Route::get('/login', function () {
		return view('dashboard');
	})->name('sign-up');
});



Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');

});

Route::get('/login', function () {
    return view('session/login-session');
})->name('login');