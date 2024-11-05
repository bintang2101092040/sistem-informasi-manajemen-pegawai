<?php

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\UserController;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\IzincutiController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\IzinabsenController;
use App\Http\Controllers\IzinsakitController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\PertanyaanController;
use App\Http\Controllers\KonfigurasiController;

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

// route untuk karyawan
Route::middleware(['guest:karyawan'])->group(function () {

    //tampilan login untuk karyawan
    Route::get('/', function () {
        return view('auth.login');
    })->name('login');

    //proses login karyawan
    Route::post('/proseslogin', [AuthController::class, 'proseslogin']);
});


//route untuk user(admin)
Route::middleware(['guest:user'])->group(function () {

    //tampilan login untuk user(admin)
    Route::get('/panel', function () {
        return view('auth.loginadmin');
    })->name('loginadmin');
    //proses login user(admin)
    Route::post('/prosesloginadmin', [AuthController::class, 'prosesloginadmin']);
});

//autentikasin untuk karyawan
Route::middleware(['auth:karyawan'])->group(function () {

    //tampilan dashboard karyawan
    Route::get('/dashboard', [DashboardController::class, 'index']);
    //proses logout dashboard karyawan
    Route::get('/proseslogout', [AuthController::class, 'proseslogout']);
    //presensi karyawan
    Route::get('/presensi/create', [PresensiController::class, 'create']);
    Route::post('/presensi/store', [PresensiController::class, 'store']);
    //editprofile karyawan
    Route::get('/editprofile', [PresensiController::class, 'editprofile']);
    Route::post('/presensi/{nik}/updateprofile', [PresensiController::class, 'updateprofile']);
    //histori karyawan
    Route::get('/presensi/histori', [PresensiController::class, 'histori']);
    Route::post('/gethistori', [PresensiController::class, 'gethistori']);
    //izin karyawan
    Route::get('/presensi/izin', [PresensiController::class, 'izin']);
    Route::get('/presensi/createizin', [PresensiController::class, 'createizin']);
    Route::post('/presensi/storeizin', [PresensiController::class, 'storeizin']);

    Route::post('/presensi/cekpengajuanizin', [PresensiController::class, 'cekpengajuanizin']);
    //izin absen
    Route::get('/izinabsen', [IzinabsenController::class, 'create']);
    Route::post('/izinabsen/store', [IzinabsenController::class, 'store']);
    Route::get('/izinabsen/{izin_id}/edit', [IzinabsenController::class, 'edit']);
    Route::post('/izinabsen/{izin_id}/update', [IzinabsenController::class, 'update']);
    //izinsakir
    Route::get('/izinsakit', [IzinsakitController::class, 'create']);
    Route::post('/izinsakit/store', [IzinsakitController::class, 'store']);
    Route::get('/izinsakit/{izin_id}/edit', [IzinsakitController::class, 'edit']);
    Route::post('/izinsakit/{izin_id}/update', [IzinsakitController::class, 'update']);
    //izincuti
    Route::get('/izincuti', [IzincutiController::class, 'create']);
    Route::post('/izincuti/store', [IzincutiController::class, 'store']);
    Route::get('/izincuti/{izin_id}/edit', [IzincutiController::class, 'edit']);
    Route::post('/izincuti/{izin_id}/update', [IzincutiController::class, 'update']);
    //
    Route::get('izin/{izin_id}/showact', [PresensiController::class, 'showact']);
    Route::get('izin/{izin_id}/delete', [PresensiController::class, 'deleteizin']);
});



Route::group(['middleware' => ['role:admin|HRD|Owner,user']], function () {
    Route::get('/proseslogoutadmin', [AuthController::class, 'proseslogoutadmin']);
    Route::get('panel/dashboardadmin', [DashboardController::class, 'dashboardadmin']);
    Route::get('panelowner', [DashboardController::class, 'dashboardowner']);

    //karyawan
    Route::get('/karyawan', [KaryawanController::class, 'index']);
    Route::post('/karyawan/store', [KaryawanController::class, 'store']);
    Route::post('/karyawan/edit', [KaryawanController::class, 'edit']);
    Route::post('/karyawan/view', [KaryawanController::class, 'view']);
    Route::post('/karyawan/{nik}/update', [KaryawanController::class, 'update']);
    Route::post('/karyawan/{nik}/delete', [KaryawanController::class, 'delete']);
    Route::get('/karyawan/{nik}/resetpassword', [KaryawanController::class, 'resetpassword']);



    //kategori penilaian
    Route::get('/kategori', [PenilaianController::class, 'indexkategori']);
    Route::post('/kategori/store', [PenilaianController::class, 'store']);
    Route::post('/kategori/edit', [PenilaianController::class, 'edit']);
    Route::post('/kategori/{kode_kategori}/update', [PenilaianController::class, 'update']);
    Route::post('/kategori/{kode_kategori}/delete', [PenilaianController::class, 'delete']);
    //cuti
    Route::get('/cuti', [CutiController::class, 'index']);
    Route::post('/cuti/store', [CutiController::class, 'store']);
    Route::post('/cuti/edit', [CutiController::class, 'edit']);
    Route::post('/cuti/{kode_cuti}/update', [CutiController::class, 'update']);
    Route::post('/cuti/{kode_cuti}/delete', [CutiController::class, 'delete']);

    //pertanyaan
    Route::get('/pertanyaan', [PertanyaanController::class, 'index']);
    Route::post('/pertanyaan/store', [PertanyaanController::class, 'store']);
    Route::post('/pertanyaan/edit', [PertanyaanController::class, 'edit']);
    Route::post('/pertanyaan/{pertanyaan_id}/update', [PertanyaanController::class, 'update']);
    Route::post('/pertanyaan/{pertanyaan_id}/delete', [PertanyaanController::class, 'delete']);
    //penilaian
    Route::get('/karyawan/pertanyaan', [KaryawanController::class, 'indexpertanyaan']);

    //presensi
    Route::get('/presensi/monitoring', [PresensiController::class, 'monitoring']);
    Route::post('/getpresensi', [PresensiController::class, 'getpresensi']);
    Route::post('/tampilkanpeta', [PresensiController::class, 'tampilkanpeta'])->name('tampilkanpeta');
    //laporan presensi
    Route::get('/presensi/laporanpresensi', [PresensiController::class, 'laporan']);
    Route::post('/presensi/cetaklaporan', [PresensiController::class, 'cetaklaporan']);

    //laporan gaji
    Route::get('/presensi/laporangaji', [PresensiController::class, 'gaji']);
    Route::post('/presensi/cetakgaji', [PresensiController::class, 'cetakgaji']);

    //rekaap presensi
    Route::get('/presensi/rekappresensi', [PresensiController::class, 'rekap']);
    Route::post('/presensi/cetakrekap', [PresensiController::class, 'cetakrekap']);

    //aprroval izin sakit
    Route::get('/presensi/izinsakit', [PresensiController::class, 'izinsakit']);
    Route::post('/presensi/approveizinsakit', [PresensiController::class, 'approveizinsakit']);
    Route::get('/presensi/{izin_id}/batalkanizinsakit', [PresensiController::class, 'batalkanizinsakit']);

    //kantor cabang
    Route::get('/cabang', [CabangController::class, 'index']);
    Route::post('/cabang/store', [CabangController::class, 'store']);
    Route::post('/cabang/edit', [CabangController::class, 'edit']);
    Route::post('/cabang/{kode_cabang}/update', [CabangController::class, 'update']);
    Route::post('/cabang/{kode_cabang}/delete', [CabangController::class, 'delete']);

    //jabatan
    Route::get('/jabatan', [JabatanController::class, 'index']);
    Route::post('/jabatan/store', [JabatanController::class, 'store']);
    Route::post('/jabatan/edit', [JabatanController::class, 'edit']);
    Route::post('/jabatan/{nama_jabatan}/update', [JabatanController::class, 'update']);
    Route::post('/jabatan{nama_jabatan}/delete', [JabatanController::class, 'delete']);
    //konfigurasi lokasi kantor
    Route::get('/konfigurasi/lokasikantor', [KonfigurasiController::class, 'lokasikantor']);
    Route::post('/konfigurasi/updatelokasikantor', [KonfigurasiController::class, 'updatelokasikantor']);

    Route::get('/konfigurasi/users', [UserController::class, 'index']);
    Route::post('/konfigurasi/users/store', [UserController::class, 'store']);
    Route::post('/konfigurasi/users/edit', [UserController::class, 'edit']);
    Route::post('/konfigurasi/users/{id_user}/update', [UserController::class, 'update']);
    Route::post('/konfigurasi/users/{id_user}/delete', [UserController::class, 'delete']);


    //penilaian
    Route::get('/evaluations', [PenilaianController::class, 'index'])->name('evaluations.index');
    Route::get('/evaluations/create/{nik}', [PenilaianController::class, 'create'])->name('evaluations.create');
    Route::post('/evaluations/store/{nik}', [PenilaianController::class, 'storenilai'])->name('evaluations.store');
    Route::get('/evaluations/show/{nik}', [PenilaianController::class, 'show'])->name('evaluations.show');
    Route::get('/evaluations/calculate/{nik}', [PenilaianController::class, 'calculate'])->name('evaluations.calculate');



    Route::get('/pending-cuti-count', [DashboardController::class, 'getPendingCutiCount']);

    Route::get('/pending-cuti-list', [DashboardController::class, 'getPendingCutiList']);
});


Route::get('/createrolepermission', function () {

    try {
        $role = Role::create(['name' => 'Owner']);
        // Permission::create(['name' => 'view-karyawan']);
        // Permission::create(['name' => 'view-cuti']);
        echo "Sukses";
    } catch (\Exception $e) {
        echo "Error";
    }
});

Route::get('/give-user-role', function () {
    try {
        $user = User::findOrFail(1);
        $user->assignRole('admin');
        echo "Sukses";
    } catch (\Exception $e) {
        echo "Error";
    }
});

Route::get('/give-role-permission', function () {
    try {
        $role = Role::findOrFail(1);
        $role->givePermissionTo('view-cuti');
        echo "Sukses";
    } catch (\Exception $e) {
        echo "Error";
    }
});
