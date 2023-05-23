<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\myController;
use App\Models\Avatar;
use App\Http\Controllers\StatisticController;

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


Route::middleware(['web'])->group(function () {

    //Trang Dashboard
    Route::get('/Dashboard', [myController::class, 'showDashboard'])->name('chart')->middleware('check.access');

    Route::get('/statistics', [myController::class, 'statistics'])->name('statistics');

    //Trang Báo cáo
    Route::get('/Baocao', [myController::class, 'showBaocao'])->name('baocao.showBaocao')->middleware('check.access');

    //tải file baocao
    Route::get('/download-data', [myController::class, 'downloadData'])->name('download.data');

    //--------------------------------------------------------------Trang tài khaonr-------------------------------------------------

    //Quản lý tài khoản
    //show
    Route::get('/quanlytaikhoan', [myController::class, 'showTaiKhoan'])->middleware('check.access');
    //thêm tài khoản
    Route::get('/Themtaikhoan', [myController::class, 'ThemTK1'])->name('Themtaikhoan');

    Route::post('/Themtaikhoan', [myController::class, 'ThemTK'])->name('Themtaikhoan');

    Route::get('/Quanlytaikhoan', [myController::class, 'showtaikhoan'])->name('dichvu.showtaikhoan');

    //cập nhật tài khoản
    Route::post('/capnhattaikhoan', [myController::class, 'Capnhattaikhoan'])->name('Capnhattaikhoan');


    Route::get('/Nhatky', [myController::class, 'showNhatky'])->name('Nhatky.showNhatky')->middleware('check.access');
    //capnhat thietbi
    Route::get('/updateTK/{MemberID}/edit', [myController::class, 'editTK'])->name('taikhoan.editTK');
    Route::match(['put', 'patch'], '/updateTK/{MemberID}', [myController::class, 'updateTK'])->name('taikhoan.updateTK');


    //--------------------------------------------------------------Trang vai trò-------------------------------------------------
    //Hiển thị trang quản lý vaitro
    Route::get('/Vaitro', function () {
        return view('Menu/Quanlyvaitro/quanlyvaitro');
    });
    //thêm
    Route::get('/Themvaitro', function () {
        return view('Menu/Quanlyvaitro/themvaitro');

    });
    Route::post('/Themvaitro', [myController::class, 'ThemVT'])->name('Themthietbi.ThemVT')->middleware('check.access');
    //update vai trò
    Route::get('/updateVT/{ID_VT}/edit', [myController::class, 'editVT'])->name('vaitro.editVT');
    Route::match(['put', 'patch'], '/updateVT/{ID_VT}', [myController::class, 'updateVT'])->name('vaitro.updateVT');



    //show vai trò
    Route::get('/Vaitro', [myController::class, 'showvaitro'])->name('vaitro.showvaitro')->middleware('check.access');

    //--------------------------------------------------------------Thiết bị-------------------------------------------------
    //Trang thiết bị
    Route::get('/Thietbi', [myController::class, 'showthietbi'])->middleware('check.access');
    //chitietTB
    Route::get('/chitietTB/{ID_Tb}', [myController::class, 'showchitietTB'])->name('thietbi.showchitietTB');


    //Thêm thiết bị
    Route::get('/Themthietbi', function () {
        return view('Menu/Thietbi/themthietbi');
    })->middleware('check.access');
    Route::get('/Themthietbi', [myController::class, 'eiditthietbi'])->name('thietbi.eiditthietbi')->middleware('check.access');
    Route::post('/Themthietbi', [myController::class, 'store'])->name('Themthietbi.store')->middleware('check.access');
    //capnhat thietbi
    Route::get('/updateTB/{ID_Tb}/edit', [myController::class, 'editThietBi'])->name('thietbi.editTB')->middleware('check.access');
    Route::match(['put', 'patch'], '/updateTB/{ID_Tb}', [myController::class, 'updateTB'])->name('thietbi.updateTB')->middleware('check.access');

    //---------------------------------- Trang Dịch vụ--------------------------------------------------------------
    //show dịch vụ
    Route::get('/Dichvu', [myController::class, 'showdichvu'])->name('dichvu.showdichvu')->middleware('check.access');
    //chi tiết dịch vụ
    Route::get('/chitietDV/{ID_Dv}', [myController::class, 'showchitietDV'])->name('dichvu.showchitietDV');

    //thêm dịch vụ
    Route::get('/ThemDV', function () {
        return view('Menu/Dichvu/themdichvu');
    })->middleware('check.access');


    Route::post('/ThemDV', [myController::class, 'ThemDV'])->name('dichvu.ThemDV')->middleware('check.access');

    //cập nhật dịch vụ
    Route::get('/updateDV/{ID_Dv}/edit', [myController::class, 'editDV'])->name('dichvu.editDV')->middleware('check.access');
    Route::match(['put', 'patch'], '/updateDV/{ID_Dv}', [myController::class, 'updateDV'])->name('dichvu.updateDV')->middleware('check.access');


    /// ------------------------------------------Tang Cấp số-----------------------------------------
    //show dịch vụ
    Route::get('/Capso', [myController::class, 'showcapso'])->name('dichvu.showcapso')->middleware('check.access');

    //chi tiết dịch vụ
    Route::get('/chitietCS/{STT}', [myController::class, 'showchitietCS'])->name('capso.showchitietCS')->middleware('check.access');

    //thêm cấp số
    Route::get('/Capsomoi', function () {
        return view('Menu/Capso/Capsomoi');
    })->middleware('check.access');

    Route::get('/Capsomoi', [myController::class, 'editCapsomoi'])->name('capso.showcapso')->middleware('check.access');


    Route::post('/Capsomoi', [myController::class, 'Capsomoi'])->name('capso.Capsomoi')->middleware('check.access');



    /// ------------------------------------------Tang Tài khoản ca nhân-----------------------------------------

    //upload avatar
    // //Trang cá nhân
    Route::post('/taikhoancanhan', [myController::class, 'uploadAvatar'])->name('uploadimg');


    Route::get('/taikhoancanhan', function () {
        if (session()->has('user')) {
            $avatar = Avatar::where('member_id', Auth::user()->MemberID)->first();
            return view('personalaccount', ['avatar' => $avatar]);
        } else {
            return redirect('/login');
        }
    })->name('personalaccount');

    Route::get('/register', function () {
        return view('register');
    });
    Route::post('/register', [myController::class, 'dangkythanhvien']);
    Route::post('/register/submit', [myController::class, 'nhandi']);


    /// ------------------------------------------Tang Đăng nhập-----------------------------------------
    Route::get('/login', function () {
        return view('login');
    });

    Route::post('/login', [myController::class, 'dangnhap'])->name('login');

    Route::post('/nhandi', [myController::class, 'nhandi']);

    /// ------------------------------------------Tang quên mật khẩu-----------------------------------------
    Route::get('/quenmatkhau', function () {
        return view('Forgotpassword');
    });

    Route::get('/getPass/{email}/{token}/edit', [myController::class, 'editgetPass'])->name('pass.editgetPass');
    Route::match(['put', 'patch'], '/getPass1/{email}/{token}', [myController::class, 'getPass'])->name('getPass');


    Route::post('/quenmatkhau', [myController::class, 'forgot_Password'])->name('quenmatkhau');
    Route::post('/nhandi', [myController::class, 'nhandi']);



    // đăng xuất
    Route::get('/logout', function () {
        session()->forget('user');
        return redirect('/login');
    });
});
