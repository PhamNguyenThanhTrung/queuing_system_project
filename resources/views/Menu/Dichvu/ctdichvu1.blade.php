@extends("Template.templates")

@section('header')
<?php

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

$user = session('user');
$user = Auth::user();
$currentTime = Carbon::now();
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
                        <span style="padding-left: 10px;"><a href="{{url('/')}}/Dichvu" style="color: #848387; text-decoration: none;">Danh sách dịch vụ</a></span>
                        <span style="font-size: 10px; position: absolute; top: 38px;"><i class="fa-solid fa-chevron-right"></i></span>
                        <span style="color: orangered; padding-left: 10px;">Chi tiết dịch vụ</span></p>
                    </div>
                </div>

                    <h5 style="color: orangered; font-size: 28px;">Quản lý dịch vụ</h5>
                    <div style="display: flex; margin-bottom: 30px;">

                    <div class="khung_themthietbi" style="height: 630px; width: 380px; padding-left: 10px;">
                        <div class="container">
                            <p style="padding-top: 10px; font-size: 25px; font-weight: 500; color: orangered;">Thông tin dịch vụ</p>

                            <div class="row">

                                <div class="col-lg-6" style="width: 130px;"><p>Mã dịch vụ:</p></div>
                                <div class="col-lg-6" style="width: 130px; color: #848387;"><span>{{$dichvu->code_Dv}}</span></div>

                                <div class="col-lg-6" style="width: 130px;"><p>Tên dịch vụ:</p></div>
                                <div class="col-lg-6" style="width: 210px; color: #848387;"><span>{{$dichvu->Name_Dv}}</span></div>

                                <div class="col-lg-6" style="width: 130px;"><p>Mô tả:</p></div>
                                <div class="col-lg-6" style="width: 210px; color: #848387;"><span>{{$dichvu->Describe_Dv}}</span></div>

                            </div>

                            <p style="font-size: 25px; font-weight: 500; color: orangered;">Quy tắc cấp số</p>

                            <div class="row">

                            @if (strpos($dichvu->Rules_of_grant, '999') !== false)
    <div class="col-lg-6" style="width: 170px;">
        <label class="form-check-label" style="font-size: 18px; font-weight: 600;">Tăng tự động:</label>
    </div>
    <div class="col-lg-6">
        <label>
            <span class="tangtudong">
            <input value=" 0001" class="col-md-4" disabled>
            </span>
            <span style="font-size: 18px; font-weight: 600;">đến</span>
            <span class="tangtudong">
               <input value=" 9999" class="col-md-4" disabled>
            </span>
        </label>
    </div>
    @endif
@if (strpos($dichvu->Rules_of_grant, 'Prefix:0001') !== false)
    <div class="col-lg-6" style="width: 170px; margin-top: 20px;">
        <label class="form-check-label" style="font-size: 18px; font-weight: 600;">Prefix:</label>
    </div>
    <div class="col-lg-6" style="margin-top: 20px;">
        <label>
            <span class="tangtudong">
            <input value=" 0001" class="col-md-4" disabled>
            </span>
        </label>
    </div>
@endif
@if (strpos($dichvu->Rules_of_grant, 'surfix:0001') !== false)
    <div class="col-lg-6" style="width: 170px; margin-top: 20px;">
        <label class="form-check-label" style="font-size: 18px; font-weight: 600;">Surfix:</label>
    </div>
    <div class="col-lg-6" style="margin-top: 20px;">
        <label>
            <span class="tangtudong">
            <input value=" 0001" class="col-md-4" disabled>
            </span>
        </label>
    </div>
@endif
@if (strpos($dichvu->Rules_of_grant, 'resetday') !== false)
    <div class="col-lg-6" style="width: 170px; margin-top: 20px;">
        <label class="form-check-label" style="font-size: 18px; font-weight: 600;">Reset theo ngày</label>
    </div>

@endif

                            </div>

                            <p style="font-size: 19px; font-weight: 400; line-height: 40px;">Ví dụ: 201-2001</p>

                        </div>
                    </div>

                    <div class="khung_themthietbi ms-4" style="height: 630px; width: 700px;">
                        <div class="container">

                            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                            <script>
                                $(document).ready(function() {
                                    $('.dropd_capso').change(function() {
                                        $(this).closest('form').submit();
                                    });
                                });
                            </script>


                        <div class="row" style="width: 800px;">
                        <!-- Danh sách thiết bị -->
                            <div class="col-lg-10">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <p style="font-weight: 600; line-height: 30px; margin-top: 11px;">Trạng thái <br>
                                            <span class="dropdown-icon_capso">
                                                <select name="Tinhtrang" class="dropd_capso">
                                                    <option value="" disabled hidden selected>Tất cả</option>
                                                    <option value="Đang chờ">Đang chờ</option>
                                                    <option value="Đã sử dụng">Đã sử dụng</option>
                                                    <option value="Bỏ qua">Bỏ qua</option>
                                                </select>
                                                <span class="icon_dropd"><i class="fa-solid fa-caret-down"></i></span>
                                            </span>
                                        </p>
                                    </div>
                                    <div class="col-lg-4" style="margin-left: 50px; width: 300px;">
                                        <p style="font-weight: 600; margin-bottom: 5px; margin-top: 11px;">Chọn thời gian</p>
            <p style="display: flex; align-items: center;">
                <input type="date" class="chonthoigian" name="thoigian_dau" value="{{ $thoigian_dau ?? '' }}"  onchange="this.form.submit()">
                <span style="font-size: 16px; margin: 0px 10px;"><i class="fa-solid fa-caret-right"></i></span>
                <input type="date" class="chonthoigian" name="thoigian_cuoi" value="{{ $thoigian_cuoi ?? '' }}" onchange="this.form.submit()">
            </p>

            <script>
                function submitFilterForm() {
                    document.getElementById('filter-form').submit();
                }

                // Tự động submit form khi ngày được chọn
                document.addEventListener('DOMContentLoaded', function() {
                    document.querySelectorAll('.chonthoigian').forEach(function(input) {
                        input.addEventListener('change', submitFilterForm);
                    });
                });
            </script>


                                    </div>
                                  <div class="col-lg-4" style="width:150px;">
                <p style="font-weight: 600; line-height: 40px;">Từ khóa
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
                                    <!-- Dòng dữ liệu -->
                                    @foreach($capsos as $capso)
                                        <!-- Dòng dữ liệu phù hợp với điều kiện -->
                                        @if($capso->Name_Dv == $dichvu->Name_Dv)
                                            <tr class="color-tr-white">
                                                <td>{{$capso->STT}}</td>
                                                <td class="border-table">
                                                    @if ($currentTime > $capso->expired_at)
                                        <svg width="8" height="9" viewBox="0 0 8 9" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="4" cy="4.5" r="4" fill="#FF0000" />
                                        </svg>{{ $capso->Tinhtrang = 'Bỏ qua' }}now()
                                        <?php
                                        $currentTime = now();
                                        if ($currentTime > $capso->expired_at) {
                                            $capso->Tinhtrang = 'Bỏ qua';
                                        } elseif ($currentTime < $capso->created_at->addMinutes(15)) {
                                            $capso->Tinhtrang = 'Đã sử dụng';
                                        } else {
                                            $capso->Tinhtrang = 'Đang chờ';
                                        }

                                        $capso->save();

                                        $capso->save();
                                        ?>
                                    @elseif($currentTime < $capso->created_at->addMinutes(15))
                                        <svg width="8" height="9" viewBox="0 0 8 9" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="4" cy="4.5" r="4" fill="#4277ff" />
                                        </svg> {{ $capso->Tinhtrang = 'Đã sử dụng' }} <?php echo now(); ?>
                                        <?php
                                        $currentTime = now();
                                        if ($currentTime > $capso->expired_at) {
                                            $capso->Tinhtrang = 'Bỏ qua';
                                        } elseif ($currentTime < $capso->created_at->addMinutes(15)) {
                                            $capso->Tinhtrang = 'Đã sử dụng';
                                        } else {
                                            $capso->Tinhtrang = 'Đang chờ';
                                        }

                                        $capso->save();

                                        ?>
                                    @else
                                        <svg width="8" height="9" viewBox="0 0 8 9" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="4" cy="4.5" r="4" fill="#4277ff" />
                                        </svg> {{ $capso->Tinhtrang = 'Đang chờ' }}
                                        <?php
                                        $currentTime = now();
                                        if ($currentTime > $capso->expired_at) {
                                            $capso->Tinhtrang = 'Bỏ qua';
                                        } elseif ($currentTime < $capso->created_at->addMinutes(15)) {
                                            $capso->Tinhtrang = 'Đã sử dụng';
                                        } else {
                                            $capso->Tinhtrang = 'Đang chờ';
                                        }

                                        $capso->save();

                                        ?>
                                    @endif
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Phân trang -->
                            <div class="phantrang" style="margin-left: 315px;">
                                <ul class="trang">
                                    <!-- Nút trang trước -->
                                    @if ($capsos->currentPage() > 1)
                                        <li>
                                            <a href="{{ $capsos->previousPageUrl() }}" style="font-size: 29px;"><i class="fa-solid fa-caret-left"></i></a>
                                        </li>
                                    @endif

                                    <!-- Các nút trang -->
                                    @if ($capsos->lastPage() > 1)
                                        @foreach ($capsos->getUrlRange(1, $capsos->lastPage()) as $page => $url)
                                            @if ($page == $capsos->currentPage())
                                                <li class="modautrang"><a href="{{ $url }}">{{ $page }}</a></li>
                                            @else
                                                <li><a href="{{ $url }}">{{ $page }}</a></li>
                                            @endif
                                        @endforeach
                                    @endif

                                    <!-- Nút trang sau -->
                                    @if ($capsos->hasMorePages())
                                        <li>
                                            <a href="{{ $capsos->nextPageUrl() }}" style="font-size: 29px;"><i class="fa-solid fa-caret-right"></i></a>
                                        </li>
                                    @endif
                                </ul>
                            </div>



                        </div>
                        </div>
                        <!--  -->

                        <!-- Phân trang -->



                        </div>
                    </div>
                    <!-- Button cập nhật thiết bị -->
                    <div>
                    <div class="themthietbi" style="margin-left: 25px; margin-top: 25px; width: 90px; height: 90px; border-radius: 5px 5px 0 0;">
                        <a href="{{ route('dichvu.editDV',['ID_Dv' => $dichvu->ID_Dv]) }}" style="text-decoration: none; color: orangered; display: block;">
                            <div style="text-align: center;">
                               <p>  <i class="fa-solid fa-square-pen"></i> <br>
                                Cập nhật danh sách</p>
                            </div>
                        </a>
                    </div>
                    <div class="themthietbi" style="margin-top: 1px; padding-top: 12px; margin-left: 25px; width: 90px; height: 80px; border-radius: 0 0 5px 5px;">
                        <a href="{{url('')}}/dichvu" style="text-decoration: none; color: orangered;">
                            <div style="text-align: center;">
                               <a></a> <p><i class="fa-solid fa-rotate-left"></i><br>
                                    Quay lại</p>
                            </div>
                        </a>
                    </div>
                </div>

            </div>
            @endif
    </form>

@endsection

