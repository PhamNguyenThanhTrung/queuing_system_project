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
        @if($user = session('user'))
            <div class="container mt-4" >

                <div class="row">
                    <!-- Chia khung bên trái -->
                    <div class="col-lg-4">
                        <p style="width: 1200px; font-weight: 600; font-size: larger; margin-top: 5px; color: #848387;">Cài đặt hệ thống
                        <span style="font-size: 10px; position: absolute; top: 38px;"><i class="fa-solid fa-chevron-right"></i></span>
                        <span style="color: orangered; padding-left: 10px;">Quản lý tài khoản</span></p>
                    </div>
                </div>

                <div class="mt-3">
                    <h5 style="color: orangered; font-size: 28px;">Danh sách tài khoản</h5>
                    <div class="row" style="width: 1200px;">
                        <!-- Danh sách thiết bị -->
                        <div class="col-lg-10">
                            <div class="row">
                            <div class="col-lg-4">
                                <p style="font-weight: 600; line-height: 40px;">Tên vai trò
                                    <span class="dropdown-icon">
                                    <select name="Vaitro" class="dropd"  onchange="this.form.submit()">
                                        <option value="" disabled hidden selected>Tất cả</option>
                                        <option value="Tất cả">Tất cả</option>
                                        <option value="Kế toán">Kế toán</option>
                                        <option value="Quản lý">Quản lý</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Bác sĩ">Bác sĩ</option>
                                        <option value="Lễ tân">Lễ tân</option>
                                        <option value="Superadmin">Superadmin</option>
                                    </select>
                                    <span class="icon_dropd"><i class="fa-solid fa-caret-down"></i></span>
                                    </span>
                                </p>
                            </div>




                            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                            <script>
                                $(document).ready(function() {
                                    $('.dropd').change(function() {
                                        $(this).closest('form').submit();
                                    });
                                });
                            </script>
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
                                    <td class="th-border-left" style="color: #ffffff; font-size: 16px;">Tên đăng nhập</td>
                                    <td class="border-table" style="color: #ffffff; font-size: 16px;">Họ tên</td>
                                    <td class="text-light" style="color: #ffffff; font-size: 16px;">Số điện thoại</td>
                                    <td class="border-table" style="color: #ffffff; font-size: 16px;">Email</td>
                                    <td class="border-table" style="color: #ffffff; font-size: 16px;">Vai trò</td>
                                    <td class="text-light" style="color: #ffffff; font-size: 16px;">Trạng thái hoạt động</td>
                                    <td class="th-border-right" style="color: #ffffff; font-size: 16px;"></td>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($members as $member)
                                    <tr class="color-tr-white">
                                        @if ($loop->last)
                                            <td class="th-border-bottom-left">
                                                {{ $member->UserDN }}
                                            </td>
                                        @else
                                            <td>
                                                {{ $member->UserDN }}
                                            </td>
                                        @endif

                                        <td class="border-table">{{ $member->MemberName }}</td>
                                        <td class="border-table">{{ $member->Tel }}</td>
                                        <td class="border-table">{{ $member->Email }}</td>
                                        <td class="border-table">{{ $member->Vaitro }}</td>
                                        <td>
                                        @if($member->Tinhtrang == 'Hoạt động')
                                    <svg width="8" height="9" viewBox="0 0 8 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="4" cy="4.5" r="4" fill="#34C759" />
                                    </svg>
                                    @else
                                    <svg width="8" height="9" viewBox="0 0 8 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="4" cy="4.5" r="4" fill="red" />
                                    </svg>
                                    @endif
                                    {{$member->Tinhtrang }}
                                </td>
                                        </td>

                                        @if ($loop->last)
                                            <td class="th-border-bottom-right">
                                                <a href="{{ route('taikhoan.editTK',['MemberID' => $member->MemberID]) }}">Cập nhật</a></td>
                                        @else
                                        <td><a href="{{ route('taikhoan.editTK',['MemberID' => $member->MemberID]) }}">Cập nhật</a></td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            </div>

                            <!-- Button thêm thiết bị -->
                            <div class="themthietbi">
                                <a href="{{url('/')}}/Themtaikhoan" style="text-decoration: none; color: orangered;">
                                    <div>
                                        <p><i class="fa-solid fa-square-plus"></i><br>
                                        Thêm <br> tài khoản</p>
                                    </div>
                                </a>
                            </div>

                        </div>
                    <!--  -->
                </div>

                <!-- Phân trang -->
                 <!-- Phân trang -->
        <div class="phantrang">

            <ul class="trang">
                <!-- Nút trang trước -->
                @if ($members->currentPage() > 1)
                    <li>
                        <a href="{{ $members->previousPageUrl() }}" style="font-size: 29px;"><i
                                class="fa-solid fa-caret-left"></i></a>
                    </li>
                @endif

                <!-- Các nút trang -->
                @php
                    $startPage = max($members->currentPage() - 1, 1);
                    $endPage = min($members->currentPage() + 1, $members->lastPage());
                @endphp

                @if ($startPage > 1)
                    <li><a href="{{ $members->url(1) }}">1</a></li>
                    @if ($startPage > 2)
                        <li><a href="#">...</a></li>
                    @endif
                @endif

                @for ($page = $startPage; $page <= $endPage; $page++)
                    @if ($page == $members->currentPage())
                        <li class="modautrang"><a href="{{ $members->url($page) }}">{{ $page }}</a></li>
                    @else
                        <li><a href="{{ $members->url($page) }}">{{ $page }}</a></li>
                    @endif
                @endfor

                @if ($endPage < $members->lastPage())
                @if ($endPage < $members->lastPage() - 1)
                    <li><a href="#">...</a></li>
                @endif
                <li><a href="{{ $members->url($members->lastPage()) }}">{{ $members->lastPage() }}</a></li>
            @endif
                <!-- Nút trang sau -->
                @if ($members->hasMorePages())
                    <li>
                        <a href="{{ $members->nextPageUrl() }}" style="font-size: 29px;"><i
                                class="fa-solid fa-caret-right"></i></a>
                    </li>
                @endif
            </ul>
            @if(session('success'))
            <script>
                alert('{{ session('success') }}');

            </script>
            @endif



        </div>

            </div>
            @endif
        </form>

@endsection

