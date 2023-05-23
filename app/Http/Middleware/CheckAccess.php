<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Else_;
use Symfony\Component\HttpFoundation\Response;

class CheckAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */


    public function handle($request, Closure $next)
{
    $user = Auth::user();
 if ($user && $user->Nhom_A) {


    // Kiểm tra vai trò của người dùng
    if (($user->Nhom_A=== 'ThemDuLieu')) {
        // Người dùng có vai trò "Lễ tân"

        // Kiểm tra chức năng yêu cầu
        if ( $request->has('tangtudong1') || $request->has('Admin')) {
            // Người dùng không được phép thêm hoặc cập nhật chức năng
            // Xử lý thông báo lỗi hoặc chuyển hướng đến trang khác
            return redirect()->back()->with('success', 'Bạn không có quyền thực hiện hành động này.');
        }
    }else

    if (($user->Nhom_A==='ChiXem')) {
        // Người dùng có vai trò "Lễ tân"

        // Kiểm tra chức năng yêu cầu
        if ($request->has('tangtudong1') || $request->has('tangtudong') || $request->has('Admin')) {
            // Người dùng không được phép thêm hoặc cập nhật chức năng
            // Xử lý thông báo lỗi hoặc chuyển hướng đến trang khác
            return redirect()->back()->with('success', 'Bạn không có quyền thực hiện hành động này.');
        }
    }


    else if (($user->Nhom_A===  'ChinhSuaDuLieu')) {
        // Người dùng có vai trò "Lễ tân"

        // Kiểm tra chức năng yêu cầu
        if ($request->has('tangtudong') || $request->has('Admin')) {
            // Người dùng không được phép thêm hoặc cập nhật chức năng
            // Xử lý thông báo lỗi hoặc chuyển hướng đến trang khác
            return redirect()->back()->with('success', 'Bạn không có quyền thực hiện hành động này.');
        }
    }

    else

    if (($user->Nhom_A=== 'QuanLyTaiKhoan')) {
        // Người dùng có vai trò "Lễ tân"
        if ($request->has('Dashboard') || $request->has('Thietbi') || $request->has('Capso') || $request->has('Dichvu') || $request->has('Baocao')) {
            // Người dùng không được phép thêm hoặc cập nhật chức năng
            // Xử lý thông báo lỗi hoặc chuyển hướng đến trang khác
            return redirect()->back()->with('success', 'Bạn không có quyền thực hiện hành động này.');
        }

    }






    if (($user->Nhom_A=== 'ChiXem,ThemDuLieu,ChinhSuaDuLieu,QuanLyTaiKhoan')) {
        // Người dùng có vai trò "Lễ tân"

        // Kiểm tra chức năng yêu cầu
        if ( $request->has('Admin1')) {
            // Người dùng không được phép thêm hoặc cập nhật chức năng
            // Xử lý thông báo lỗi hoặc chuyển hướng đến trang khác
            return redirect()->back()->with('success', 'Bạn không có quyền thực hiện hành động này.');
        }

    }


    if (($user->Nhom_A=== 'ChiXem,ChinhSuaDuLieu,QuanLyTaiKhoan')) {
        // Người dùng có vai trò "Lễ tân"

        // Kiểm tra chức năng yêu cầu
        if ( $request->has('tangtudong')){
            // Người dùng không được phép thêm hoặc cập nhật chức năng
            // Xử lý thông báo lỗi hoặc chuyển hướng đến trang khác
            return redirect()->back()->with('success', 'Bạn không có quyền thực hiện hành động này.');
        }

    }




    if (($user->Nhom_A=== 'ChiXem,ThemDuLieu,QuanLyTaiKhoan')) {
        // Người dùng có vai trò "Lễ tân"

        // Kiểm tra chức năng yêu cầu
        if ( $request->has('tangtudong1') ){
            // Người dùng không được phép thêm hoặc cập nhật chức năng
            // Xử lý thông báo lỗi hoặc chuyển hướng đến trang khác
            return redirect()->back()->with('success', 'Bạn không có quyền thực hiện hành động này.');
        }


}

if (($user->Nhom_A=== 'ChiXem,ThemDuLieu')) {
    // Người dùng có vai trò "Lễ tân"

    // Kiểm tra chức năng yêu cầu
    if ( $request->has('Admin') ||$request->has('tangtudong1') ){
        // Người dùng không được phép thêm hoặc cập nhật chức năng
        // Xử lý thông báo lỗi hoặc chuyển hướng đến trang khác
        return redirect()->back()->with('success', 'Bạn không có quyền thực hiện hành động này.');
    }


}
if (($user->Nhom_A=== 'ChiXem,ChinhSuaDuLieu')) {
    // Người dùng có vai trò "Lễ tân"

    // Kiểm tra chức năng yêu cầu
    if ( $request->has('Admin') ||$request->has('tangtudong') ){
        // Người dùng không được phép thêm hoặc cập nhật chức năng
        // Xử lý thông báo lỗi hoặc chuyển hướng đến trang khác
        return redirect()->back()->with('success', 'Bạn không có quyền thực hiện hành động này.');
    }


}


if (($user->Nhom_A=== 'ChiXem,ThemDuLieu,ChinhSuaDuLieu')) {
    // Người dùng có vai trò "Lễ tân"

    // Kiểm tra chức năng yêu cầu
    if ( $request->has('Admin')) {
        // Người dùng không được phép thêm hoặc cập nhật chức năng
        // Xử lý thông báo lỗi hoặc chuyển hướng đến trang khác
        return redirect()->back()->with('success', 'Bạn không có quyền thực hiện hành động này.');
    }

}
if (($user->Nhom_A=== 'ChiXem,QuanLyTaiKhoan')) {
    // Người dùng có vai trò "Lễ tân"

    // Kiểm tra chức năng yêu cầu
    if ( $request->has('tangtudong1') ||$request->has('tangtudong') ){
        // Người dùng không được phép thêm hoặc cập nhật chức năng
        // Xử lý thông báo lỗi hoặc chuyển hướng đến trang khác
        return redirect()->back()->with('success', 'Bạn không có quyền thực hiện hành động này.');
    }

}

if (($user->Nhom_A=== 'ThemDuLieu,QuanLyTaiKhoan')) {
    // Người dùng có vai trò "Lễ tân"

    // Kiểm tra chức năng yêu cầu
    if ( $request->has('tangtudong1') ){
        // Người dùng không được phép thêm hoặc cập nhật chức năng
        // Xử lý thông báo lỗi hoặc chuyển hướng đến trang khác
        return redirect()->back()->with('success', 'Bạn không có quyền thực hiện hành động này.');
    }

}

if (($user->Nhom_A=== 'ChinhSuaDuLieu,QuanLyTaiKhoan')) {
    // Người dùng có vai trò "Lễ tân"

    // Kiểm tra chức năng yêu cầu
    if ( $request->has('tangtudong') ){
        // Người dùng không được phép thêm hoặc cập nhật chức năng
        // Xử lý thông báo lỗi hoặc chuyển hướng đến trang khác
        return redirect()->back()->with('success', 'Bạn không có quyền thực hiện hành động này.');
    }

}












    return $next($request);
}
return $next($request);

}

}
