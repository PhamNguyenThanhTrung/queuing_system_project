@extends("Template.templates")

@section('header')
<?php

use Illuminate\Support\Facades\Auth;

$user = session('user');
$user = Auth::user();

?>
        <!-- Hiện thông tin user -->

        <div style="width: 1220px; background-color: #f7f7f7; border: 1px solid #f7f7f7;">
        @csrf

            <div class="container mt-4" >

                <div class="row">
                    <!-- Chia khung bên trái -->
                    <div class="col-lg-4">
                        <p style="width: 1200px; font-weight: 600; font-size: larger; margin-top: 5px; color: #848387;">Cài đặt hệ thống
                        <span style="font-size: 10px; position: absolute; top: 38px;"><i class="fa-solid fa-chevron-right"></i></span>
                        <span style="padding-left: 10px;"><a href="{{url('/')}}/quanlytaikhoan" style="color: #848387; text-decoration: none;">Quản lý tài khoản</a></span>
                        <span style="font-size: 10px; position: absolute; top: 38px;"><i class="fa-solid fa-chevron-right"></i></span>
                        <span style="color: orangered; padding-left: 10px;">Thêm tài khoản</span></p>
                    </div>
                </div>

                <div class="mt-2">
                    <h5 style="color: orangered; font-size: 28px;">Quản lý thiết bị</h5>
                    <div class="khung_themthietbi">
                        <div class="container">
                            <p style="padding-top: 20px; font-size: 25px; font-weight: 500; color: orangered;">Thông tin tài khoản</p>


                                <!-- Input họ tên -->
                                <form method="POST" action="{{ route('taikhoan.updateTK',$member->MemberID) }}">
                                    @csrf
                                    @method('PUT')
                                    <!-- Input họ tên -->
                                    <div class="row">

                                                <div class="col-lg-6">
                                        <p>Họ tên: <span class="text-danger">*</span>
                                        <input type="text" class="nhap_themthietbi" value="{{$member->MemberName}}" name="MemberName" placeholder="Nhập họ tên" style="color: #848387;">
                                            @if($errors->has('MemberName'))
                                                <span class="text-danger">{{$errors->first('MemberName')}}</span>
                                            @endif
                                        </p>
                                    </div>

                                    <!-- Input tên đăng nhập -->
                                    <div class="col-lg-6">
                                        <p>Tên đăng nhập: <span class="text-danger">*</span>
                                        <input type="text" class="nhap_themthietbi" value="{{$member->UserDN}}" name="UserDN" placeholder="Nhập tên đăng nhập" style="color: #848387;">
                                            @if($errors->has('UserDN'))
                                                <span class="text-danger">{{$errors->first('UserDN')}}</span>
                                            @endif
                                        </p>
                                    </div>



                                    <!-- Input số điện thoại -->
                                    <div class="col-lg-6">
                                        <p>Số điện thoại: <span class="text-danger">*</span>
                                        <input type="text" class="nhap_themthietbi" value="{{$member->Tel}}" name="Tel" placeholder="Nhập số điện thoại" style="color: #848387;">
                                            @if($errors->has('Tel'))
                                                <span class="text-danger">{{$errors->first('Tel')}}</span>
                                            @endif
                                        </p>
                                    </div>

                                    <!-- Input mật khẩu -->
                                    <div class="col-lg-6">
                                        <p>Mật khẩu: <span class="text-danger">*</span>
                                        <input type="password" class="nhap_themthietbi" value="{{$member->password}}" name="password" placeholder="Nhập mật khẩu" style="color: #848387;">
                                            @if($errors->has('password'))
                                                <span class="text-danger">{{$errors->first('password')}}</span>
                                            @endif
                                        </p>
                                    </div>

                                     <!-- Input email -->
                                     <div class="col-lg-6">
                                        <p>Email: <span class="text-danger">*</span>
                                        <input type="email" class="nhap_themthietbi" value="{{$member->Email}}" name="Email" placeholder="Nhập email" style="color: #848387;">
                                            @if($errors->has('Email'))
                                                <span class="text-danger">{{$errors->first('Email')}}</span>
                                            @endif
                                        </p>
                                    </div>

                                    <!-- Input nhập lại mật khẩu -->
                                    <div class="col-lg-6">
                                        <p>Nhập lại mật khẩu: <span class="text-danger">*</span>
                                        <input type="password" class="nhap_themthietbi" name="confirm_password"value="{{$member->password}}"  placeholder="Nhập lại mật khẩu" style="color: #848387;">
                                            @if($errors->has('confirm_password'))
                                                <span class="text-danger">{{$errors->first('confirm_password')}}</span>
                                            @endif
                                        </p>
                                    </div>

                                    <!-- Input địa chỉ IP -->
                                    <div class="col-lg-6">
                                        <p>Vai trò: <span class="text-danger">*</span>
                                            <span class="dropdown-loai" >
                                                <select name="Vaitro" class="select_loai">
                                                    <option value="" disabled hidden >Chọn vai trò</option>
                                                    <option value="Kế toán" {{ $member->Vaitro == 'Kế toán' ? 'selected' : '' }}>Kế toán</option>
                                                    <option value="Quản lý"{{ $member->Vaitro == 'Quản lý' ? 'selected' : '' }}>Quản lý</option>
                                                    <option value="Admin"{{ $member->Vaitro == 'Admin' ? 'selected' : '' }}>Admin</option>
                                                    <option value="Bác sĩ"{{ $member->Vaitro == 'Bác sĩ' ? 'selected' : '' }}>Bác sĩ</option>
                                                    <option value="Lễ tân"{{ $member->Vaitro == 'Lễ tân' ? 'selected' : '' }}>Lễ tân</option>
                                                    <option value="Superadmin"{{ $member->Vaitro == 'Superadmin' ? 'selected' : '' }}>Superadmin</option>
                                                </select>
                                                <span class="icon_dropd"><i class="fa-solid fa-caret-down"></i></span>
                                            </span>
                                            @if($errors->has('Vaitro'))
                                                <span class="text-danger">{{$errors->first('Vaitro')}}</span>
                                            @endif
                                        </p>
                                    </div>

                                    <!-- Input mật khẩu -->
                                    <div class="col-lg-6">
                                        <p>Tình trạng: <span class="text-danger">*</span>
                                            <span class="dropdown-loai">
                                                <select name="Tinhtrang" class="select_loai">
                                                    <option value="" disabled hidden selected>Tất cả</option>
                                                    <option value="Hoạt động"{{ $member->Tinhtrang == 'Hoạt động' ? 'selected' : '' }}>Hoạt động</option>
                                                    <option value="Ngưng hoạt động"{{ $member->Tinhtrang == 'Ngưng hoạt động' ? 'selected' : '' }}>Ngưng hoạt động</option>
                                                </select>
                                                <span class="icon_dropd"><i class="fa-solid fa-caret-down"></i></span>
                                            </span>
                                            @if($errors->has('Tinhtrang'))
                                                <span class="text-danger">{{$errors->first('Tinhtrang')}}</span>
                                            @endif
                                        </p>
                                    </div>


                                    <p style="font-size: 16px; font-weight: 500; color: #848387;"><span class="text-danger">*</span> Là trường thông tin bắt buộc</p>
                                </div>





                                    <p style="margin-top: 140px; margin-left: 357px;">
                                        <a href="{{url('/')}}/quanlytaikhoan">
                                            <button type="button" class="button_huy">Hủy bỏ</button>
                                        </a>
                                        <a href="#">
                                            <button type="submit" class="button_xn">Cập nhật tài khoản </button>
                                        </a>
                                    </p>
                                        @if(isset($success))
                                            <script>
                                                alert('{{$success}}');
                                                window.location.href = "/Queuing_system/quanlytaikhoan";
                                            </script>
                                        @endif
                                    </form>


    <!-- Button thêm thiết bị -->




                        </div>
                    </div>
                </div>

            </div>
        </div>

@endsection

