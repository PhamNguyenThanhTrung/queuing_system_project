@extends("Template.templates")

@section('header')

<?php

use Illuminate\Support\Facades\Auth;

$user = session('user');
$user = Auth::user();

?>


        <!-- Hiện thông tin user -->

        <form enctype="multipart/form-data" method="post">
        @csrf
            <div class="container mt-4">

                <div class="row">
                    <!-- Chia khung bên trái -->
                    <div class="col-lg-2">
                        <p style="color: orangered; font-weight: 600; font-size: larger; margin-top: 5px;">Thông tin cá nhân</p>
                    </div>
                </div>

                <!-- Thông tin của user -->
                <div class="khung">
                    <div class="container">
                        <div class="row">
                            @if($user = session('user'))
                            <!-- Hình user -->
                                   <!-- Hình user -->
                                   <div class="col-lg-3 pt-4">
                                    <!-- Avatar user -->
                                    {{-- <img id="avatar-image" src="{{ asset($avatar->Name_Img) }}" class="icon_avatar"> --}}
                                    <img id="avatar-image" src="{{ asset($avatar->Name_Img ?? 'storage/app/public/pp.png') }}" class="icon_avatar">

                                    <!-- Tên user -->
                                    <h5>{{ $user->membername }}</h5>

                                    <form id="upload-form" action="{{ route('uploadimg') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="Name_Img" class="custom-file-upload">
                                                <p class="icon_camera"><i class="fa-sharp fa-solid fa-camera"></i></p>
                                            </label>
                                            <input id="Name_Img" type="file" name="Name_Img" style="display: none;">
                                        </div>
                                        <button id="submit-btn" type="submit" style="display: none;">Upload</button>
                                    </form>

                                    <script>
                                        document.getElementById('Name_Img').addEventListener('change', function() {
                                            document.getElementById('submit-btn').click();
                                        });
                                    </script>


                                </div>

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <script>
                                    function previewImage(event) {
                                        var input = event.target;
                                        if (input.files && input.files[0]) {
                                            var reader = new FileReader();
                                            reader.onload = function (e) {
                                                var imageElement = document.getElementById('avatar-image');
                                                imageElement.src = e.target.result;
                                            };
                                            reader.readAsDataURL(input.files[0]);
                                        }
                                    }
                                </script>













                            <!-- Thông tin user -->
                            <div class="col-lg-9 pt-4">
                                <div class="row" style="line-height: 40px;">
                                    <!-- Input người dùng -->
                                    <div class="col-lg-6">
                                    @if($user = session('user'))
                                        <p><span style="font-weight: 600;">Tên người dùng *</span>
                                            <input type="text" class="nhap_avatar" name="tennd" disabled placeholder="{{ $user->MemberName }}">
                                        </p>
                                        @else
                                        <p><span style="font-weight: 600;">Tên người dùng *</span>
                                            <input type="text" class="nhap_avatar" name="tennd" disabled>
                                        </p>
                                    @endif
                                    </div>
                                    <!-- Input đăng nhập -->
                                    <div class="col-lg-6">
                                        <p><span style="font-weight: 600;">Tên đăng nhập *</span>
                                            <input type="text" class="nhap_avatar" name="tendn" disabled placeholder="{{ $user->UserDN }}">
                                        </p>
                                    </div>
                                    <!-- Input số điện thoại -->
                                    <div class="col-lg-6">
                                        <p><span style="font-weight: 600;">Số điện thoại *</span>
                                            <input type="number" class="nhap_avatar" name="sdt" disabled placeholder="{{ $user->Tel }}">
                                        </p>
                                    </div>
                                    <!-- Input mật khẩu -->
                                    <div class="col-lg-6">
                                        <p><span style="font-weight: 600;">Mật khẩu *</span>
                                            <input type="password" class="nhap_avatar" name="matkhau" disabled placeholder="{{ $user->password }}">
                                        </p>
                                    </div>
                                    <!-- Input email -->
                                    <div class="col-lg-6">
                                        <p><span style="font-weight: 600;">Email *</span>
                                            <input type="text" class="nhap_avatar" name="email" disabled placeholder="{{ $user->Email }}">
                                        </p>
                                    </div>
                                    <!-- Input vai trò -->
                                    <div class="col-lg-6">
                                        <p><span style="font-weight: 600;">Vai trò *</span>
                                            <input type="text" class="nhap_avatar" name="vaitro" disabled placeholder="{{ $user->Vaitro }}">
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @if(session('success'))
                <script>
                    alert('{{ session('success') }}');

                </script>
                @endif


            </div>
            </form>

@endsection

