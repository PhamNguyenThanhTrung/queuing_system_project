@extends("Template.templates")

@section('header')
<?php

use Illuminate\Support\Facades\Auth;

$user = session('user');
$user = Auth::user();

?>
<form action="" style="width: 1250px; background-color: #f7f7f7; border: 1px solid #f7f7f7;">
    @csrf
    @if($user = session('user'))
    <div class="container mt-4">

        <div class="row">
            <!-- Chia khung bên trái -->
            <div class="col-lg-4">
                <p style="width: 1200px; font-weight: 600; font-size: larger; margin-top: 5px; color: #848387;">Dịch vụ
                    <span style="font-size: 10px; position: absolute; top: 38px;"><i class="fa-solid fa-chevron-right"></i></span>
                    <span style="padding-left: 10px;"><a href="{{url('/')}}/dichvu" style="color: #848387; text-decoration: none;">Danh sách dịch vụ</a></span>
                    <span style="font-size: 10px; position: absolute; top: 38px;"><i class="fa-solid fa-chevron-right"></i></span>
                    <span style="color: orangered; padding-left: 10px;">Chi tiết dịch vụ</span>
                </p>
            </div>
        </div>

        <h5 style="color: orangered; font-size: 28px;">Quản lý dịch vụ</h5>
        <div style="display: flex; margin-bottom: 30px;">

            <div class="khung_themthietbi" style="height: 630px; width: 380px; padding-left: 10px;">
                <div class="container">
                    <p style="padding-top: 10px; font-size: 25px; font-weight: 500; color: orangered;">Thông tin dịch vụ</p>

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="col-lg-6" style="width: 130px;">
                                <p>Mã dịch vụ:</p>
                            </div>
                            <div class="col-lg-6" style="width: 130px; color: #848387;"><span>{{$dichvu->code_Dv}}</span></div>

                            <div class="col-lg-6" style="width: 130px;">
                                <p>Tên dịch vụ:</p>
                            </div>
                            <div class="col-lg-6" style="width: 210px; color: #848387;"><span>{{$dichvu->Name_Dv}}</span></div>

                            <div class="col-lg-6" style="width: 130px;">
                                <p>Mô tả:</p>
                            </div>
                            <div class="col-lg-6" style="width: 210px; color: #848387;"><span>{{$dichvu->Describe_Dv}}</span></div>

                        </div>

                        <p style="font-size: 25px; font-weight: 500; color: orangered;">Quy tắc cấp số</p>

                        <div class="row">

                            <div class="col-lg-6">
                                <div class="form-check">
                                    <label for="auto-increment">Tăng tự động từ</label>
                                    <input type="checkbox" name="Rules_of_grant" id="auto-increment" onchange="toggleAutoIncrementFields()" required {{ $dichvu->Rules_of_grant ? 'checked' : '' }}>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label>
                                    <span class="tangtudong">
                                        <input type="text" style="width:60px;" name="auto-increment-start" id="auto-increment-start" disabled placeholder="0001" {{ $dichvu->Rules_of_grant ? '' : 'disabled' }}>đến
                                        <input type="text" style="width:60px;" name="auto-increment-end" id="auto-increment-end" disabled placeholder="9999" {{ $dichvu->Rules_of_grant ? '' : 'disabled' }}>
                                    </span>
                                </label>
                            </div>


                            <p style="font-size: 19px; font-weight: 400; line-height: 40px;">Ví dụ: 201-2001</p>

                        </div>

                    </div>


                </div>

            </div>
        </div>

        <div class="col-log-8">
            <div class="khung_themthietbi ms-4" style="height: 630px; width: 700px;">
                <div class="container">

                    <div class="row" style="width: 800px;">
                        <!-- Danh sách thiết bị -->
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-lg-2">
                                    <p style="font-weight: 600; line-height: 30px; margin-top: 11px;">Trạng thái <br>
                                        <span class="dropdown-icon_capso">
                                            <select name="hoatdong" class="dropd_capso">
                                                <option value="" disabled hidden selected>Tất cả</option>
                                                <option value="Đã hoàn thành">Đã hoàn thành</option>
                                                <option value="Đã thực hiện">Đã thực hiện</option>
                                                <option value="Vắng">Vắng</option>
                                            </select>
                                            <span class="icon_dropd"><i class="fa-solid fa-caret-down"></i></span>
                                        </span>
                                    </p>
                                </div>
                                <div class="col-lg-4" style="margin-left: 50px; width: 300px;">
                                    <p style="font-weight: 600; margin-bottom: 5px; margin-top: 11px;">Chọn thời gian</p>
                                    <p style="display: flex; align-items: center;">
                                        <input type="date" class="chonthoigian" name="thoigian_dau">
                                        <span style="font-size: 16px; margin: 0px 10px;"><i class="fa-solid fa-caret-right"></i></span>
                                        <input type="date" class="chonthoigian" name="thoigian_cuoi">
                                    </p>
                                </div>
                                <div class="col-lg-6" style="width: 185px;">
                                    <p style="font-weight: 600; line-height: 40px;">Từ khóa <br>
                                        <span class="dropdown-icon_search_ct">
                                            <input type="search" class="dropd_search" style="width: 180px;" name="timkiem" placeholder="Nhập từ khóa">
                                            <span class="icon_search"><i class="fa-solid fa-magnifying-glass"></i></span>
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4"></div>
                    </div>
                    <!--  -->
                    <div class="content-device">
                        <div class="table-list-device" style="width: 700px;">

                            <table style="width: 640px;">
                                <thead>
                                    <tr>
                                        <td class="th-border-left" style="color: #ffffff; font-size: 16px;">Số thứ tự</td>
                                        <td class="border-table-left th-border-right" style="color: #ffffff; font-size: 16px;">Trạng thái</td>
                                    </tr>
                                </thead>
                                <tbody>

                                    <!-- Dòng thứ nhất -->
                                    <tr class="color-tr-white">
                                        <td>2</td>
                                        <td class="border-table-left">
                                            <svg width="8" height="9" viewBox="0 0 8 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="4" cy="4.5" r="4" fill="#35c75a" />
                                            </svg> Đã hoàn thành
                                        </td>
                                    </tr>

                                    <!-- Dòng thứ hai -->
                                    <tr class="color-tr-or">
                                        <td>2010002</td>
                                        <td class="border-table-left">
                                            <svg width="8" height="9" viewBox="0 0 8 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="4" cy="4.5" r="4" fill="#35c75a" />
                                            </svg> Đã hoàn thành
                                        </td>
                                    </tr>

                                    <!-- Dòng thứ ba -->
                                    <tr class="color-tr-white">
                                        <td>2010003</td>
                                        <td class="border-table-left">
                                            <svg width="8" height="9" viewBox="0 0 8 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="4" cy="4.5" r="4" fill="#4277ff" />
                                            </svg> Đang thực hiện
                                        </td>
                                    </tr>

                                    <!-- Dòng thứ tư -->
                                    <tr class="color-tr-or">
                                        <td>2010004</td>
                                        <td class="border-table-left">
                                            <svg width="8" height="9" viewBox="0 0 8 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="4" cy="4.5" r="4" fill="#7e7d88" />
                                            </svg> Vắng
                                        </td>
                                    </tr>

                                    <!-- Dòng thứ năm -->
                                    <tr class="color-tr-white">
                                        <td>2010005</td>
                                        <td class="border-table-left">
                                            <svg width="8" height="9" viewBox="0 0 8 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="4" cy="4.5" r="4" fill="#35c75a" />
                                            </svg> Đã hoàn thành
                                        </td>
                                    </tr>

                                    <!-- Dòng thứ sáu -->
                                    <tr class="color-tr-or">
                                        <td>2010006</td>
                                        <td class="border-table-left">
                                            <svg width="8" height="9" viewBox="0 0 8 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="4" cy="4.5" r="4" fill="#4277ff" />
                                            </svg> Đang thực hiện
                                        </td>
                                    </tr>

                                    <!-- Dòng thứ bảy -->
                                    <tr class="color-tr-white">
                                        <td>2010007</td>
                                        <td class="border-table-left">
                                            <svg width="8" height="9" viewBox="0 0 8 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="4" cy="4.5" r="4" fill="#7e7d88" />
                                            </svg> Vắng
                                        </td>
                                    </tr>

                                    <!-- Dòng thứ hai -->
                                    <tr class="color-tr-or">
                                        <td class="th-border-bottom-left">2010007</td>
                                        <td class="border-table-left th-border-bottom-right">
                                            <svg width="8" height="9" viewBox="0 0 8 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="4" cy="4.5" r="4" fill="#35c75a" />
                                            </svg> Đã hoàn thành
                                        </td>
                                    </tr>

                                </tbody>
                            </table>

                        </div>
                    </div>
                    <!--  -->

                    <!-- Phân trang -->
                    <div class="phantrang" style="margin-left: 315px;">
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
                    </div>

                </div>
            </div>
            <!-- Button cập nhật thiết bị -->
            <div>
                <div class="themthietbi" style="margin-left: 25px; margin-top: 25px; width: 90px; height: 90px; border-radius: 5px 5px 0 0;">
                    <a href="{{url('')}}/capnhatdichvu" style="text-decoration: none; color: orangered; display: block;">
                        <div style="text-align: center;">
                            <p><i class="fa-solid fa-square-pen"></i> <br>
                                Cập nhật danh sách</p>
                        </div>
                    </a>
                </div>
                <div class="themthietbi" style="margin-top: 1px; padding-top: 12px; margin-left: 25px; width: 90px; height: 80px; border-radius: 0 0 5px 5px;">
                    <a href="{{url('')}}/dichvu" style="text-decoration: none; color: orangered;">
                        <div style="text-align: center;">
                            <p><i class="fa-solid fa-rotate-left"></i><br>
                                Quay lại</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    @endif
</form>

@endsection
