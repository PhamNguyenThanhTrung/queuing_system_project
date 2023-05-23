<?php

use Illuminate\Support\Facades\Auth;

$user = session('user');
$user = Auth::user();

?>
<!-- Hiện khung menu -->
<p class="img"><a href="{{url('/')}}/taikhoancanhan"><img src="https://phamnguyenthanhtrung.github.io/Image_queuing_system/Imgs/Logo.jpg" width="45%" height="45%" alt=""></a></p>
<div class="menu">
    <ul>
        <li><a href="{{url('/')}}/taikhoancanhan"><i class="fa-brands fa-windows"></i> Dashboard</a></li>
        <li><a href="{{url('/')}}/Thietbi"><i class="fa-solid fa-computer"></i> Thiết bị</a></li>
        <li><a href="{{url('/')}}/Dichvu"><i class="fa-brands fa-servicestack"></i> Dịch vụ</a></li>
        <li><a href="{{url('/')}}/Capso"><i class="fa-brands fa-dropbox"></i> Cấp số</a></li>
        <li><a href="{{url('/')}}/Baocao"><i class="fa-solid fa-bookmark"></i> Báo cáo</a></li>
        <li>
            <div class="dropdown dropend">
                <p data-bs-toggle="dropdown"><a href="#">
                        <i class="fa-solid fa-gear"></i> Cài đặt hệ thống
                        <i class="fa-solid fa-ellipsis-vertical"></i></a></p>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{url('')}}/Vaitro">Quản lý vai trò</a></li>
                    <li><a class="dropdown-item" href="{{url('')}}/Themtaikhoan">Quản lý tài khoản</a></li>
                    <li><a class="dropdown-item" href="{{url('')}}/Nhatky">Nhật ký người dùng</a></li>
                </ul>
            </div>
        </li>
    </ul>
</div>

<!-- Nút button đăng nhập -->
<p style="text-align: center;">
    @if($user = session('user'))
    <a href="{{ url('/logout') }}">
        <button type="button" class="button_dn">
            <i class="fa-solid fa-arrow-right-from-bracket"></i> Đăng xuất
        </button>
    </a>
    @else
    <a href="{{ url('/login') }}">
        <button type="button" class="button_dn">
            <i class="fa-solid fa-arrow-right-from-bracket"></i> Đăng nhập
        </button>
    </a>
    @endif
</p>

<div style="display: flex; position: absolute; top: 20px; width: 100px;">
    <div style="width: 30px; margin-left: 1100px;">
        @if($user = session('user'))
        <div class="dropdown">
            <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <button type="button" class="icon_notify"><i class="fa-solid fa-bell"></i></button>
            </a>
            <div class="dropdown-menu dropdown-menu-start dropdown-menu-notification dropdown-menu-end">
                <div class="header-notification">
                    <p>Thông báo</p>
                </div>
                <div class="list-notification">
                    <div class="item-notification">
                    @foreach($capsos as $capso)
                        <p class="text-user-notifi">

                            Người dùng:
                            <!-- Dòng thứ nhất -->



                            {{$capso->MemberName}}


                        </p>
                        <p class="condition-notifi">Thời gian nhận số:    {{$capso->created_at}}</p>
                        @endforeach
                    </div>
                
                </div>
            </div>
        </div>
        @else
        <div>
            <a href="#">
                <p class="icon_notify_chuadn"><i class="fa-solid fa-bell"></i></p>
            </a>
        </div>
        @endif
    </div>
    <div style="display: flex;">
        <!-- Chia khung cho avatar -->
        @if($user = session('user'))
        <div style="width: 40px; height: 40px; margin-left: 20px;">

            <img src="{{asset('./storage/app/public/goku.png')}}" class="icon_avatar">

        </div>
        @endif
        <!-- Chia khung cho tên người dùng -->
        @if($user = session('user'))
        <div style="width: 200px; height: 40px; margin-left: 10px;">
            <p style="color:#848387; line-height: 20px; margin-top: 1px;">Xin chào <br>
                <span style="color: black; font-weight: 500;">{{ $user->MemberName }}</span>
            </p>
        </div>
        @elseif(!View::hasSection('themthietbi'))
        <div style="width: 180px; height: 40px; margin-left: 20px;">
            <p style="color:#848387; line-height: 20px; margin-top: 1px;">Xin chào <br>
                <span style="color: black; font-weight: 500;">Bạn cần đăng nhập</span>
            </p>
        </div>
        @endif
    </div>
</div>