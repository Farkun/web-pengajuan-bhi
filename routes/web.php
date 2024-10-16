<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengajuController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\AccountantController;
use App\Http\Controllers\BendaharaController;
use App\Http\Controllers\BendaharayController;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/superadmin/dashboard', function () {
    return view('superadmin.dashboard');
})->middleware(['auth', 'verified'])->name('superadmin.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'role:1'])->group(function () {
    Route::get('/superadmin/dashboard', [UserController::class, 'superadminDashboard'])->name('superadmin.dashboard');
    Route::get('/superadmin/create', [UserController::class, 'create'])->name('superadmin.create');
    Route::post('/superadmin/store', [UserController::class, 'store'])->name('users.store');
    Route::get('/superadmin/daftarakun', [UserController::class, 'index'])->name('superadmin.daftarakun');
    Route::delete('/superadmin/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::post('/superadmin/reset/{id}', [UserController::class, 'resetPassword'])->name('user.resetPassword');
});

Route::get('/superadmin/tambahakun', function () {
    return view('superadmin.tambahakun');
})->name('superadmin.tambahakun');

// Pengaju
Route::get('/pengaju/dashboard', function () {
    return view('pengaju.dashboard');
})->middleware(['auth', 'verified'])->name('pengaju.dashboard');

Route::middleware(['auth', 'role:2'])->group(function(){
    Route::get('/pengaju/result', [PengajuController::class, 'index'])->name('pengaju.result');
    Route::get('/pengaju/status', [PengajuController::class, 'index'])->name('pengaju.status');
    Route::get('/pengaju/dashboard', [PengajuController::class, 'index'])->name('pengaju.dashboard');
    Route::get('/pengaju/dana', [PengajuController::class, 'create'])->name('pengaju.dana');
    Route::post('/pengaju/store', [PengajuController::class, 'store'])->name('pengaju.store');
    Route::delete('/pengaju/{id}', [PengajuController::class, 'destroy'])->name('pengaju.destroy');
    Route::get('/pengaju/detailp/{id}', [PengajuController::class, 'show'])->name('pengaju.detailp');
    Route::get('/pengaju/details/{id}', [PengajuController::class, 'shows'])->name('pengaju.details');
});

Route::get('/pengaju/dana', function () {
    return view('pengaju.dana');
})->name('pengaju.dana');

Route::get('/pengaju/status', function () {
    return view('pengaju.status');
})->name('pengaju.status');

Route::get('/pengaju/result', function () {
    return view('pengaju.result');
})->name('pengaju.result');

Route::get('/pengaju/detailstat', function () {
    return view('pengaju.detail');
})->name('pengaju.detail');

// Approval
Route::middleware(['auth', 'role:3'])->group(function () {
    Route::get('/approval/status', [ApprovalController::class, 'index'])->name('approval.status');
    Route::post('/approval/store', [ApprovalController::class, 'store'])->name('approval.store');
    Route::get('/approval/detailstat/{id}', [ApprovalController::class, 'show'])->name('approval.detailstat');
});

Route::get('/approval/status', function () {
    return view('approval.status');
})->middleware(['auth', 'verified'])->name('approval.status');

Route::get('/approval/laporan', function () {
    return view('approval.laporan');
})->name('approval.laporan');

Route::get('/approval/detaillap', function () {
    return view('approval.detaillap');
})->name('approval.detaillap');

// Accountant
Route::middleware(['auth', 'role:4'])->group(function () {
    Route::get('/accountant/dashboard', [AccountantController::class, 'accountantDashboard'])->name('accountant.dashboard');
    Route::get('/accountant/data', [AccountantController::class, 'index'])->name('accountant.data');
    Route::get('/accountant/detail/{id}', [AccountantController::class, 'show'])->name('accountant.detail');
    Route::get('/accountant/detailket/{id}', [AccountantController::class, 'shows'])->name('accountant.detailket');
    Route::post('/accountant/forward', [AccountantController::class, 'forward'])->name('accountant.forward');
    Route::post('/accountant/forwardtwo', [AccountantController::class, 'forwardtwo'])->name('accountant.forwardtwo');
    Route::get('/accountant/rekap', [AccountantController::class, 'indexForwarded'])->name('accountant.rekap');
});

Route::get('/accountant/dashboard', function () {
    return view('accountant.dashboard');
})->middleware(['auth', 'verified'])->name('accountant.dashboard');

Route::get('/accountant/data', function () {
    return view('accountant.data');
})->name('accountant.data');

// Bendahara
Route::get('/bendahara/dashboard', function () {
    return view('bendahara.dashboard');
})->middleware(['auth', 'verified'])->name('bendahara.dashboard');

Route::get('/bendahara/laporan', function () {
    return view('bendahara.laporan');
})->name('bendahara.laporan');



// Route::get('/bendahara/status', function () {
//     return view('bendahara.status');
// })->name('bendahara.status');
Route::middleware(['auth', 'role:5'])->group(function () {
Route::get('/bendahara/status', [BendaharaController::class, 'index'])->name('bendahara.status');
Route::get('/bendahara/detail/{id}', [BendaharaController::class, 'show'])->name('bendahara.detail');
Route::get('/bendahara/export/excel', [BendaharaController::class, 'export_excel'])->name('bendahara.export.excel');
});

// Bendahara Yayasan
Route::middleware(['auth', 'role:6'])->group(function () {
    Route::get('/bendaharay/dashboard', [BendaharayController::class, 'bendaharayDashboard'])->name('bendaharay.dashboard');
    Route::get('/bendaharay/data', [BendaharayController::class, 'index'])->name('bendaharay.data');
    Route::post('/bendaharay/store', [BendaharayController::class, 'store'])->name('bendaharay.store');
    Route::get('/bendaharay/detail/{id}', [BendaharayController::class, 'show'])->name('bendaharay.detail');
    Route::post('/bendaharay/approve-all', [BendaharayController::class, 'approveAll'])->name('bendaharay.approve-all');
    Route::get('/bendaharay/dashboard', [DashboardController::class, 'bendaharay'])->name('bendaharay.dashboard');
});


//Dashboard kontoller
Route::middleware(['auth', 'role:1'])->group(function () {
    Route::get('/superadmin/dashboard', [DashboardController::class, 'superadmin'])->name('superadmin.dashboard');
});

Route::middleware(['auth', 'role:2'])->group(function () {
    Route::get('/pengaju/dashboard', [DashboardController::class, 'pengaju'])->name('pengaju.dashboard');
});

Route::middleware(['auth', 'role:3'])->group(function () {
    Route::get('/approval/status', [DashboardController::class, 'approval'])->name('approval.status');
});

Route::middleware(['auth', 'role:4'])->group(function () {
    Route::get('/accountant/dashboard', [DashboardController::class, 'accountant'])->name('accountant.dashboard');
});

Route::middleware(['auth', 'role:5'])->group(function () {
    Route::get('/bendahara/dashboard', [DashboardController::class, 'bendahara'])->name('bendahara.dashboard');
});

Route::get('/dashboard/{type}', [DashboardController::class, 'showDashboard'])->name('dashboard.show');




