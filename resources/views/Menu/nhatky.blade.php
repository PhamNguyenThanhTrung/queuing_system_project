@extends("Template.templates")

@section('header')
<?php

use Illuminate\Support\Facades\Auth;

$user = session('user');
$user = Auth::user();

?>
        <!-- Hiện thông tin user -->

        <form action="" style="width: 1220px; background-color: #f7f7f7; border: 1px solid #f7f7f7;">
        @csrf
            <div class="container mt-4" >

                <div class="row">
                    <!-- Chia khung bên trái -->
                    <div class="col-lg-4">
                        <p style="width: 1200px; font-weight: 600; font-size: larger; margin-top: 5px; color: #848387;">Cài đặt hệ thống
                        <span style="font-size: 10px; position: absolute; top: 38px;"><i class="fa-solid fa-chevron-right"></i></span>
                        <span style="color: orangered; padding-left: 10px;">Nhật ký hoạt động</span></p>
                    </div>
                </div>

                <div class="mt-3">
                    <div class="row" style="width: 1200px;">
                        <!-- Danh sách thiết bị -->
                        <div class="col-lg-10">
                            <div class="row">
                                <div class="col-lg-4">
                                    <p style="font-weight: 600; margin-bottom: 5px; margin-top: 11px;">Chọn thời gian</p>
                                    <p style="display: flex; align-items: center;">
                                        <input type="date" class="chonthoigian" name="thoigian_dau" value="{{ $thoigian_dau ?? '' }}"  onchange="this.form.submit()">
                                        <span style="font-size: 16px; margin: 0px 10px;"><i class="fa-solid fa-caret-right"></i></span>
                                        <input type="date" class="chonthoigian" name="thoigian_cuoi" value="{{ $thoigian_cuoi ?? '' }}" onchange="this.form.submit()">
                                    </p>
                                </div>
                            <div class="col-lg-4">
                                <!-- code... -->
                            </div>
                            <div class="col-lg-4">
                                <p style="font-weight: 600; line-height: 40px;">Từ khóa
                                    <span class="dropdown-icon">
                                        <input type="search" class="dropd" name="timkiem" placeholder="Nhập từ khóa" value="{{ $timkiem ?? '' }}" oninput="submitFilterForm()">
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
                                    <td class="th-border-left" style="color: #ffffff; font-size: 16px;">Tên đăng nhập</td>
                                    <td class="border-table" style="color: #ffffff; font-size: 16px;">Thời gian tác động</td>
                                    <td class="border-table" style="color: #ffffff; font-size: 16px;">IP thực hiện</td>
                                    <td class="th-border-right" style="color: #ffffff; font-size: 16px;">Thao tác thực hiện</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($nhatkyes as $nhatky)
                                    <!-- Dòng thứ nhất -->
                                    <tr class="color-tr-white">
                                        <td>{{$nhatky->Name_DN}}</td>
                                        <td class="border-table">{{$nhatky->created_at}}</td>
                                        <td class="border-table">{{$nhatky->host}}</td>
                                        <td>{{$nhatky->operation}}</td>
                                    </tr>

                                    @endforeach
                                </tbody>
                            </table>

                            </div>

                        </div>
                    <!--  -->
                </div>


        <!-- Phân trang -->
        <div class="phantrang">

            <ul class="trang">
                <!-- Nút trang trước -->
                @if ($nhatkyes->currentPage() > 1)
                    <li>
                        <a href="{{ $nhatkyes->previousPageUrl() }}" style="font-size: 29px;"><i
                                class="fa-solid fa-caret-left"></i></a>
                    </li>
                @endif

                <!-- Các nút trang -->
                @php
                    $startPage = max($nhatkyes->currentPage() - 1, 1);
                    $endPage = min($nhatkyes->currentPage() + 1, $nhatkyes->lastPage());
                @endphp

                @if ($startPage > 1)
                    <li><a href="{{ $nhatkyes->url(1) }}">1</a></li>
                    @if ($startPage > 2)
                        <li><a href="#">...</a></li>
                    @endif
                @endif

                @for ($page = $startPage; $page <= $endPage; $page++)
                    @if ($page == $nhatkyes->currentPage())
                        <li class="modautrang"><a href="{{ $nhatkyes->url($page) }}">{{ $page }}</a></li>
                    @else
                        <li><a href="{{ $nhatkyes->url($page) }}">{{ $page }}</a></li>
                    @endif
                @endfor

                @if ($endPage < $nhatkyes->lastPage())
                @if ($endPage < $nhatkyes->lastPage() - 1)
                    <li><a href="#">...</a></li>
                @endif
                <li><a href="{{ $nhatkyes->url($nhatkyes->lastPage()) }}">{{ $nhatkyes->lastPage() }}</a></li>
            @endif
                <!-- Nút trang sau -->
                @if ($nhatkyes->hasMorePages())
                    <li>
                        <a href="{{ $nhatkyes->nextPageUrl() }}" style="font-size: 29px;"><i
                                class="fa-solid fa-caret-right"></i></a>
                    </li>
                @endif
            </ul>




        </div>

            </div>
        </form>

@endsection

