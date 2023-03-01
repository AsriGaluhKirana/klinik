<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
    }
);

//Main
Route::get('/', 'MainController@index')->name('dashboard')->middleware('auth');

//Pasien
Route::get('/pasien', 'PasienController@index')->name('pasien')->middleware('auth');

Route::get('/pasien/tambah/', 'PasienController@tambah_pasien')->name('pasien.tambah')->middleware('auth');

Route::post('/pasien/tambah/simpan', 'PasienController@simpan_pasien')->name('pasien.simpan')->middleware('auth');

Route::post('/pasien/edit/update/', 'PasienController@update_pasien')->name('pasien.update')->middleware('auth');

Route::delete('/pasien/hapus/{id}','PasienController@hapus_pasien')->name('pasien.destroy')->middleware('auth');

Route::get('/pasien/edit/{id}','PasienController@edit_pasien')->name('pasien.edit')->middleware('auth');
//End Pasien



//rm

Route::get('/rm', 'RMController@index')->name('rm')->middleware('auth');

Route::delete('/rm/hapus/{id}','RMController@hapus_rm')->name('rm.destroy')->middleware('auth');

Route::get('/rm/edit/{id}', 'RMController@edit_rm')->name('rm.edit')->middleware('auth');

Route::get('/rm/tambah', 'RMController@tambah_rm')->name('rm.tambah')->middleware('auth');

Route::get('/rm/tambah/{idpasien}', 'RMController@tambah_rmid')->name('rm.tambah.id')->middleware('auth');

Route::post('/rm/simpan/', 'RMController@simpan_rm')->name('rm.simpan')->middleware('auth');

Route::post('/rm/update/', 'RMController@update_rm')->name('rm.update')->middleware('auth');

Route::get('/rm/list/{idpasien}', 'RMController@list_rm')->name('rm.list')->middleware('auth');

Route::get('/rm/lihat/{id}', 'RMController@lihat_rm')->name('rm.lihat')->middleware('auth');
//End rm

//Tagihan
Route::get('/pengaturan', 'PengaturanController@index')->name('pengaturan')->middleware('auth','admin');

Route::patch('/pengaturan/simpan', 'PengaturanController@simpan')->name('pengaturan.simpan')->middleware('auth','admin');
//Endtagihan

//Profile
Auth::routes([
  'register' => true,
  'verify' => false,
  'reset' => false
]);

Route::group(['prefix' => 'users'], function(){
    Route::auth();
    });

Route::get('users/profile', 'ProfileController@index')->name('profile.edit')->middleware('auth');

Route::get('users/profile/{id}', 'ProfileController@edit')->name('profile.edit.admin')->middleware('auth','admin');

Route::patch('users/profile/simpan', 'ProfileController@simpan')->name('profile.simpan')->middleware('auth');
//endProfile

//Users
Route::get('/users', 'UserController@index')->name('user')->middleware('auth','admin');

Route::delete('/users/delete/{id}', 'UserController@hapus')->name('user.destroy')->middleware('auth','admin');


//endUsers


