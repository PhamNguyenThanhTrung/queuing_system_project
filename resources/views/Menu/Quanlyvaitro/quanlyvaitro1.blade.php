@extends("Template.templates")

@section('vaitro')
<?php

use Illuminate\Support\Facades\Auth;

$user = session('user');
$user = Auth::user();

?>
@if($user = session('user'))
        <form action="" style="width: 1220px; background-color: #f7f7f7; border: 1px solid #f7f7f7;">
        @csrf
            <div class="container mt-4" >

                <div class="row">
                    <!-- Chia khung bên trái -->
                    <div class="col-lg-4">
                        <p style="width: 1200px; font-weight: 600; font-size: larger; margin-top: 5px; color: #848387;">Cài đặt hệ thống
                        <span style="font-size: 10px; position: absolute; top: 38px;"><i class="fa-solid fa-chevron-right"></i></span>
                        <span style="color: orangered; padding-left: 10px;">Quản lý vai trò</span></p>
                    </div>
                </div>

                <div class="mt-3">
                    <h5 style="color: orangered; font-size: 28px; margin-bottom: -40px;">Danh sách vai trò</h5>
                    <div class="row" style="width: 1200px;">
                        <!-- Danh sách thiết bị -->
                        <div class="col-lg-10">
                            <div class="row">
                            <div class="col-lg-4">
                                <!-- code... -->
                            </div>
                            <div class="col-lg-4">
                                <!-- code... -->
                            </div>
                                <div class="col-lg-4">
                                    <p style="font-weight: 600; line-height: 40px; margin-left: 150px;">Từ khóa
                                        <span class="dropdown-icon">
                                            <input type="search" class="dropd" name="timkiem" placeholder="Nhập từ khóa">
                                            <span class="icon_search"><i class="fa-solid fa-magnifying-glass"></i></span>
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2"></div>
                    </div>
                    <!--  -->
                    <div class="content-device" style="display: flex;">
                        <div class="table-list-device">
                            <table>
                                <thead>
                                    <tr>
                                    <td class="th-border-left" style="color: #ffffff; font-size: 16px;">Tên vai trò</td>
                                    <td class="border-table" style="color: #ffffff; font-size: 16px;">Số người dùng</td>
                                    <td class="border-table" style="color: #ffffff; font-size: 16px;">Mô tả</td>
                                    <td class="th-border-right" style="color: #ffffff; font-size: 16px;"></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Dòng thứ nhất -->
                                    <tr class="color-tr-white">
                                        <td>Kế toán</td>
                                        <td class="border-table">6</td>
                                        <td class="border-table">Thực hiện nhiệm vụ về thống kê số liệu và tổng hợp số liệu</td>
                                        <td><a href="{{url('')}}/capnhatvaitro">Cập nhật</a></td>
                                    </tr>

                                    <!-- Dòng thứ hai -->
                                    <tr class="color-tr-or">
                                        <td>Bác sĩ</td>
                                        <td class="border-table">6</td>
                                        <td class="border-table">Thực hiện nhiệm vụ về thống kê số liệu và tổng hợp số liệu</td>
                                        <td><a href="{{url('')}}/capnhatvaitro">Cập nhật</a></td>
                                    </tr>

                                    <!-- Dòng thứ ba -->
                                    <tr class="color-tr-white">
                                        <td>Lễ tân</td>
                                        <td class="border-table">6</td>
                                        <td class="border-table">Thực hiện nhiệm vụ về thống kê số liệu và tổng hợp số liệu</td>
                                        <td><a href="{{url('')}}/capnhatvaitro">Cập nhật</a></td>
                                    </tr>

                                    <!-- Dòng thứ tư -->
                                    <tr class="color-tr-or">
                                        <td>Quản lý</td>
                                        <td class="border-table">6</td>
                                        <td class="border-table">Thực hiện nhiệm vụ về thống kê số liệu và tổng hợp số liệu</td>
                                        <td><a href="{{url('')}}/capnhatvaitro">Cập nhật</a></td>
                                    </tr>

                                    <!-- Dòng thứ năm -->
                                    <tr class="color-tr-white">
                                        <td>Admin</td>
                                        <td class="border-table">6</td>
                                        <td class="border-table">Thực hiện nhiệm vụ về thống kê số liệu và tổng hợp số liệu</td>
                                        <td><a href="{{url('')}}/capnhatvaitro">Cập nhật</a></td>
                                    </tr>

                                    <!-- Dòng thứ sáu -->
                                    <tr class="color-tr-or">
                                        <td class="th-border-bottom-left">Superadmin</td>
                                        <td class="border-table">6</td>
                                        <td class="border-table">Thực hiện nhiệm vụ về thống kê số liệu và tổng hợp số liệu</td>
                                        <td class="th-border-bottom-right"><a href="{{url('')}}/capnhatvaitro">Cập nhật</a></td>
                                    </tr>

                                </tbody>
                            </table>

                            </div>

                            <!-- Button thêm thiết bị -->
                            <div class="themthietbi">
                                <a href="{{url('')}}/themvaitro" style="text-decoration: none; color: orangered;">
                                    <div>
                                        <p><i class="fa-solid fa-square-plus"></i><br>
                                        Thêm <br> vai trò</p>
                                    </div>
                                </a>
                            </div>

                        </div>
                    <!--  -->
                </div>

                <!-- Phân trang -->
                <!-- <div class="phantrang">
                    <ul class="trang">
                        <li>
                            <a href="#" style="font-size: 29px;"><i class="fa-solid fa-caret-left"></i></a>
                        </li>
                        <li class="modautrang"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#">...</a></li>
                        <li><a href="#">10</a></li>
                        <li>
                            <a href="#" style="font-size: 29px;"><i class="fa-solid fa-caret-right"></i></a>
                        </li>
                    </ul>
                </div> -->

            </div>
        </form>
@endif
@endsection

