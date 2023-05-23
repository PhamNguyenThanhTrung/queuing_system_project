@extends("Template.templates")




@section('header')

<?php

use Illuminate\Support\Facades\Auth;

$user = session('user');
$user = Auth::user();



?>


@if($user = session('user'))
<!-- Hiện thông tin user -->

<form action="" style="width: 1220px; background-color: #f7f7f7; border: 1px solid #f7f7f7;">
    @csrf
    <div class="container mt-4">

        <div class="row">
            <!-- Chia khung bên trái -->
            <div class="col-lg-4">
                <p style="width: 1200px; font-weight: 600; font-size: larger; margin-top: 5px; color: #848387;">Thiết bị
                    <span style="font-size: 10px; position: absolute; top: 38px;"><i class="fa-solid fa-chevron-right"></i></span>
                    <span style="color: orangered; padding-left: 10px;">Danh sách thiết bị</span>
                </p>
            </div>
        </div>

        <div class="mt-3">
            <h5 style="color: orangered; font-size: 28px;">Danh sách thiết bị</h5>
            <div class="row" style="width: 1200px;">
                <!-- Danh sách thiết bị -->
                <div class="col-lg-10">
                    <div class="row">
                        <div class="col-lg-4">
                            <p style="font-weight: 600; line-height: 40px;">Trạng thái hoạt động
                                <span class="dropdown-icon">

                                    <select name="hoatdong" class="dropd" onchange="this.form.submit()">
                                        <option value="1" hidden selected>Tất cả</option>
                                        <option value="Tất cả">Tất cả</option>
                                        <option value="Hoạt động">Hoạt động</option>
                                        <option value="Ngừng hoạt động">Ngừng hoạt động</option>
                                    </select>

                                </span>
                            </p>
                        </div>

                        <div class="col-lg-4">
                            <p style="font-weight: 600; line-height: 40px;">Trạng thái kết nối
                                <span class="dropdown-icon">
                                    <select name="ketnoi" class="dropd" onchange="this.form.submit()">
                                        <option value="" disabled hidden selected>Tất cả</option>
                                        <option value="Tất cả">Tất cả</option>
                                        <option value="Kết nối">Kết nối</option>
                                        <option value="Mất kết nối">Mất kết nối</option>
                                    </select>
                                    <span class="icon_dropd"><i class="fa-solid fa-caret-down"></i></span>
                                </span>
                            </p>
                        </div>

                        <div class="col-lg-4">
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
            <div class="content-device" style="display: flex;">
                <div class="table-list-device">
                    <table>
                        <thead>
                            <tr>
                                <td class="th-border-left" style="color: #ffffff; font-size: 16px;">Mã thiết bị</td>
                                <td class="border-table" style="color: #ffffff; font-size: 16px;">Tên thiết bị</td>
                                <td class="text-light" style="color: #ffffff; font-size: 16px;">Địa chỉ IP</td>
                                <td class="border-table" style="color: #ffffff; font-size: 16px;">Trạng thái hoạt động</td>
                                <td class="border-table" style="color: #ffffff; font-size: 16px;">Trạng thái kết nối</td>
                                <td class="border-table" style="color: #ffffff; font-size: 16px;">Dịch vụ sử dụng</td>
                                <td class="text-light" style="color: #ffffff; font-size: 16px;"></td>
                                <td class="th-border-right" style="color: #ffffff; font-size: 16px;"></td>
                            </tr>
                        </thead>
                        <tbody>

                            <!-- Dòng thứ nhất -->
                            <tr class="color-tr-white">
                                @foreach($thietbis as $thietbi)

                                <td>{{ $thietbi->code_Tb }}</td>



                                <td class="border-table">{{ $thietbi->Name_Tb }}</td>
                                <td class="border-table">{{ $thietbi->Diachi }}</td>


                                <td class="border-table">
                                    @if($thietbi->Tinhtrang == 'Hoạt động')
                                    <svg width="8" height="9" viewBox="0 0 8 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="4" cy="4.5" r="4" fill="#34C759" />
                                    </svg>
                                    @else
                                    <svg width="8" height="9" viewBox="0 0 8 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="4" cy="4.5" r="4" fill="red" />
                                    </svg>
                                    @endif
                                    {{$thietbi->Tinhtrang }}
                                </td>


                                @if($thietbi->member_id == $user->MemberID)
                                <td class="border-table">
                                    <svg width="8" height="9" viewBox="0 0 8 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="4" cy="4.5" r="4" fill="#34C759" />
                                    </svg>{{ $thietbi->TT_ketnoi = 'Kết nối'}}
                                    <?php if ($thietbi->member_id == $user->MemberID) {
                                        $thietbi->TT_ketnoi = 'Kết nối';
                                    } else {
                                        $thietbi->TT_ketnoi = 'Mất kết nối';
                                    }
                                    $thietbi->save();

    ?>
                                </td>
                                @else
                                <td class="border-table">
                                    <svg width="8" height="9" viewBox="0 0 8 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="4" cy="4.5" r="4" fill="#E73F3F" />
                                    </svg>{{ $thietbi->TT_ketnoi = 'Mất kết nối'}}
                                </td>
                                <?php if ($thietbi->member_id == $user->MemberID) {
                                    $thietbi->TT_ketnoi = 'Kết nối';
                                } else {
                                    $thietbi->TT_ketnoi = 'Mất kết nối';
                                }
                                $thietbi->save();

?>
                                @endif





                                <td class="border-table pt-3">
                                    <p style="white-space: pre-wrap;">{{ (strlen($thietbi->dichvu_Sd) > 30) ? nl2br(substr($thietbi->dichvu_Sd, 0, 30)) : $thietbi->dichvu_Sd }}{{ (strlen($thietbi->dichvu_Sd) > 8) ? '...' : '' }}<br>
                                        <br><a href="{{ route('thietbi.showchitietTB',['ID_Tb' => $thietbi->ID_Tb]) }}">Xem thêm </a></p>
                                </td>





                                <td><a href="{{ route('thietbi.editTB',['ID_Tb' => $thietbi->ID_Tb, 'tangtudong1' => 'something',]) }}">Cập nhật</a></td>


                            </tr>


                            @endforeach
                        </tbody>
                    </table>

                </div>

                <!-- Button thêm thiết bị -->
                @if($user = session('user'))
                <div class="themthietbi">
                    <a href="{{ url('/Themthietbi') }}?tangtudong=something" style="text-decoration: none; color: orangered;">

                        <div>
                            <p><i class="fa-solid fa-square-plus"></i><br>
                                Thêm thiết bị</p>
                        </div>
                    </a>
                </div>
                @endif
            </div>
            <!--  -->
        </div>

        <!-- Phân trang -->
        <div class="phantrang">

            <ul class="trang">
                <!-- Nút trang trước -->
                @if ($thietbis->currentPage() > 1)
                    <li>
                        <a href="{{ $thietbis->previousPageUrl() }}" style="font-size: 29px;"><i
                                class="fa-solid fa-caret-left"></i></a>
                    </li>
                @endif

                <!-- Các nút trang -->
                @php
                    $startPage = max($thietbis->currentPage() - 1, 1);
                    $endPage = min($thietbis->currentPage() + 1, $thietbis->lastPage());
                @endphp

                @if ($startPage > 1)
                    <li><a href="{{ $thietbis->url(1) }}">1</a></li>
                    @if ($startPage > 2)
                        <li><a href="#">...</a></li>
                    @endif
                @endif

                @for ($page = $startPage; $page <= $endPage; $page++)
                    @if ($page == $thietbis->currentPage())
                        <li class="modautrang"><a href="{{ $thietbis->url($page) }}">{{ $page }}</a></li>
                    @else
                        <li><a href="{{ $thietbis->url($page) }}">{{ $page }}</a></li>
                    @endif
                @endfor

                @if ($endPage < $thietbis->lastPage())
                @if ($endPage < $thietbis->lastPage() - 1)
                    <li><a href="#">...</a></li>
                @endif
                <li><a href="{{ $thietbis->url($thietbis->lastPage()) }}">{{ $thietbis->lastPage() }}</a></li>
            @endif
                <!-- Nút trang sau -->
                @if ($thietbis->hasMorePages())
                    <li>
                        <a href="{{ $thietbis->nextPageUrl() }}" style="font-size: 29px;"><i
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
</form>

@endif
@endsection
