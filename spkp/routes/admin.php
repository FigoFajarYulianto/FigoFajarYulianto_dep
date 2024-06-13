<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Admin\KriteriaController;

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

Route::get('login', 'AuthController@index')->name('admin.login');
Route::post('login', 'AuthController@login')->name('admin.post-login');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', 'DashboardController@index')->name('admin.index');


    // Rombel
    Route::match(['get', 'post'], 'rombel/datatable', 'Rombel\RombelController@dataTable');
    Route::match(['get', 'post'], 'rombel/select2', 'Rombel\RombelController@select2');
    Route::apiResource('rombel', 'Rombel\RombelController');

    // Siswa
    Route::match(['get', 'post'], 'siswa/datatable', 'Siswa\SiswaController@dataTable');
    Route::apiResource('siswa', 'Siswa\SiswaController');

    // Mapel
    Route::match(['get', 'post'], 'mapel/datatable', 'Mapel\MapelController@dataTable');
    Route::match(['get', 'post'], 'mapel/select2', 'Mapel\MapelController@select2');
    Route::apiResource('mapel', 'Mapel\MapelController');


    // Paket Soal
    Route::match(['get', 'post'], 'paket-soal/datatable', 'PaketSoal\PaketSoalController@dataTable');
    Route::match(['get', 'post'], 'paket-soal/select2', 'PaketSoal\PaketSoalController@select2');
    Route::apiResource('paket-soal', 'PaketSoal\PaketSoalController');

    // Soal
    Route::match(['get', 'post'], 'soal/datatable', 'Soal\SoalController@dataTable');
    // Route::match(['get', 'post'], 'soal/select2', 'Mapel\MapelController@select2');
    Route::resource('soal', 'Soal\SoalController');

    // Ujian
    Route::match(['get', 'post'], 'ujian/datatable', 'Ujian\UjianController@dataTable');
    Route::resource('ujian', 'Ujian\UjianController');

    // Riwayat Ujian
    Route::get('riwayat-ujian/', 'Ujian\RiwayatUjianController@index')->name('ujian.riwayat');
    Route::get('riwayat-ujian/datatable', 'Ujian\RiwayatUjianController@dataTable')->name('ujian.riwayat.data');
    Route::get('riwayat-ujian/hasil', 'Ujian\RiwayatUjianController@hasilUjian')->name('ujian.riwayat.hasilUjian');
    Route::get('riwayat-ujian/{ujian}', 'Ujian\RiwayatUjianController@show')->name('ujian.riwayat.show');

    // Pengaturan
    Route::get('pengaturan', 'Pengaturan\PengaturanController@index')->name('pengaturan.index');
    Route::post('pengaturan', 'Pengaturan\PengaturanController@update')->name('pengaturan.update');
    Route::post('pengaturan/slug', 'Pengaturan\PengaturanController@updateSlug')->name('pengaturan.update-slug');

    //kriteria
    // Route::get('/admin/kriterias', [KriteriaController::class, 'index'])->name('kriterias.index');
    Route::get('/kriterias', 'KriteriaController@index')->name('kriterias.index');
    Route::get('/kriterias/create', 'KriteriaController@create')->name('kriterias.create');
    Route::post('/kriterias/create', 'KriteriaController@store')->name('kriterias.store');
    Route::get('/kriterias/{kriteria:id}/edit', 'KriteriaController@edit')->name('kriterias.edit');
    Route::get('/kriterias/{kriteria:id}/show', 'KriteriaController@show')->name('kriterias.show');
    Route::put('/kriterias/{kriteria:id}', 'KriteriaController@update')->name('kriterias.update');
    Route::delete('/kriterias/{kriteria:id}', 'KriteriaController@destroy')->name('kriterias.destroy');



    //kandidat
    Route::get('/kandidats', 'KandidatController@index')->name('kandidats.index');
    Route::get('/kandidats/create', 'KandidatController@create')->name('kandidats.create');
    Route::post('/kandidats/create', 'KandidatController@store')->name('kandidats.store');
    Route::get('/kandidats/{kandidat:id}/edit', 'KandidatController@edit')->name('kandidats.edit');
    Route::get('/kandidats/{kandidat:id}/show', 'KandidatController@show')->name('kandidats.show');
    Route::put('/kandidats/{kandidat:id}', 'KandidatController@update')->name('kandidats.update');
    Route::delete('/kandidats/{kandidat:id}', 'KandidatController@destroy')->name('kandidats.destroy');


    //penilaian
    Route::get('/rekaps', 'RekapController@index')->name('rekaps.index');
    Route::get('/rekaps/{nilai:id}/create', 'RekapController@create')->name('rekaps.create');
    Route::post('/rekaps/{nilai:id}', 'RekapController@store')->name('rekaps.store');
    Route::get('/rekaps/{nilai:id}/edit', 'RekapController@edit')->name('rekaps.edit');
    Route::get('/rekaps/{nilai:id}/show', 'RekapController@show')->name('rekaps.show');
    Route::put('/rekaps/{nilai:id}', 'RekapController@update')->name('rekaps.update');
    Route::delete('/rekaps/{nilai:id}', 'RekapController@destroy')->name('rekaps.destroy');


    //penilaian
    Route::get('/nilais', 'NilaiController@index')->name('nilais.index');
    Route::get('/nilais/{nilai:id}/create', 'NilaiController@create')->name('nilais.create');
    Route::post('/nilais/{nilai:id}', 'NilaiController@store')->name('nilais.store');
    Route::get('/nilais/{nilai:id}/edit', 'NilaiController@edit')->name('nilais.edit');
    Route::get('/nilais/{nilai:id}/show', 'NilaiController@show')->name('nilais.show');
    Route::put('/nilais/{nilai:id}', 'NilaiController@update')->name('nilais.update');
    Route::delete('/nilais/{nilai:id}', 'NilaiController@destroy')->name('nilais.destroy');
    Route::delete('/nilais_all', 'NilaiController@destroyall')->name('nilais.destroyall');


    //penilaian
    Route::get('/riwayats', 'RiwayatController@index')->name('riwayats.index');
    Route::get('/riwayats/create', 'RiwayatController@create')->name('riwayats.create');
    Route::post('/riwayats/create', 'RiwayatController@store')->name('riwayats.store');
    Route::get('/riwayats/{terpilih:id}/edit', 'RiwayatController@edit')->name('riwayats.edit');
    Route::get('/riwayats/{terpilih:id}/show', 'RiwayatController@show')->name('riwayats.show');
    Route::put('/riwayats/{terpilih:id}', 'RiwayatController@update')->name('riwayats.update');
    Route::delete('/riwayats/{terpilih:id}', 'RiwayatController@destroy')->name('riwayats.destroy');


    Route::get('/perhitungan', 'PerhitunganController@list_data')->name('perhitungan.list_data');
    Route::get('/perhitungan', 'PerhitunganController@calculate')->name('perhitungan.calculate');
    Route::get('/rekap_perhitungan', 'RekapPerhitunganController@calculate')->name('rekapperhitungan.calculate');


    // user
    Route::get('/users', 'UserController@index')->name('users.index');
    Route::get('/users/create', 'UserController@create')->name('users.create');
    Route::post('/users/create', 'UserController@store')->name('users.store');
    Route::get('/users/{user:id}/edit', 'UserController@edit')->name('users.edit');
    Route::put('/users/{user:id}', 'UserController@update')->name('users.update');
    Route::delete('/users/{user:id}', 'UserController@destroy')->name('users.destroy');


    Route::get('/laporans', 'LaporanController@index')->name('laporan.index');

    // Kelas
    Route::match(['get', 'post'], 'kelas/datatable', 'Kelas\KelasController@dataTable');
    Route::match(['get', 'post'], 'kelas/select2', 'Kelas\KelasController@select2');
    Route::apiResource('kelas', 'Kelas\KelasController', [
        'parameters' => [
            'kelas' => 'kelas'
        ]
    ]);
});


// logout

Route::get('/logout', 'AuthController@logout')->name('logout.logout');
