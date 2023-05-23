@extends("Template.templates")




@section('header')

<?php

use Illuminate\Support\Facades\Auth;

$user = session('user');
$user = Auth::user();

?>
<!-- Hiện thông tin user -->

<form method="post" style="width: 1220px; background-color: #f7f7f7; border: 1px solid #f7f7f7;">
    @csrf
    @if($user = session('user'))
    <div class="container mt-4">

        <div class="row">
            <!-- Chia khung bên trái -->
            <div class="col-lg-4">
                <p style="width: 1200px; font-weight: 600; font-size: larger; margin-top: 5px; color: #848387;">Thiết bị
                    <span style="font-size: 10px; position: absolute; top: 38px;"><i class="fa-solid fa-chevron-right"></i></span>
                    <span style="padding-left: 10px;"><a href="{{url('/')}}/thietbi" style="color: #848387; text-decoration: none;">Danh sách thiết bị</a></span>
                    <span style="font-size: 10px; position: absolute; top: 38px;"><i class="fa-solid fa-chevron-right"></i></span>
                    <span style="color: orangered; padding-left: 10px;">Thêm thiết bị</span>
                </p>
            </div>
        </div>


        <div class="mt-2">
            <h5 style="color: orangered; font-size: 28px;">Quản lý thiết bị</h5>
            <div class="khung_themthietbi">
                <div class="container">
                    <p style="padding-top: 20px; font-size: 25px; font-weight: 500; color: orangered;">Thông tin thiết bị</p>
                    <div class="row">

                        <!-- Input mã thiết bị -->
                        <form method="POST" action="{{ route('Themthietbi.store') }}">
                            @csrf
                            <div class="row">
                                <!-- Chia khung bên trái -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="code_Tb">ID Thiết bị</label>
                                        <input type="text" class="form-control" name="code_Tb" required>
                                        @if($errors->has('code_Tb'))
                                        <p class="text-danger">{{ $errors->first('code_Tb') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div>

                                        <label for="Loai_Tb">Loại Thiết bị :</label><br>

                                        <span class="dropdown-loai">
                                            <select name="Loai_Tb" class="select_loai">
                                                <option value="" disabled hidden selected>Chọn loại thiết bị</option>
                                                <option value="Kiosk">Kiosk</option>
                                                <option value="Display counter">Display counter</option>
                                            </select>
                                            <span class="icon_dropd"><i class="fa-solid fa-caret-down"></i></span>
                                        </span>
                                        @if($errors->has('Loai_Tb'))
                                        <p class="text-danger">{{ $errors->first('Loai_Tb') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <!-- Chia khung bên trái -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="Name_Tb">Tên Thiết bị</label>
                                        <input type="text" class="form-control" name="Name_Tb" required>
                                        @if($errors->has('Name_Tb'))
                                        <p class="text-danger">{{ $errors->first('Name_Tb') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">

                                    <div class="form-group">
                                        <label for="UserDN">Tên đăng nhập</label>
                                        <input type="text" class="form-control" name="UserDN" required>
                                        @if($errors->has('UserDN'))
                                        <p class="text-danger">{{ $errors->first('UserDN') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <!-- Chia khung bên trái -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <span class="dropdown-loai">
                                            <label for="Diachi">Địa chỉ</label>
                                            <input type="text" class="form-control" name="Diachi" required>
                                            @if($errors->has('Diachi'))
                                            <p class="text-danger">{{ $errors->first('Diachi') }}</p>
                                            @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">

                                    <div class="form-group">
                                        <label for="password">Mật khẩu</label>
                                        <input type="password" class="form-control" name="password" required>
                                        @if($errors->has('error'))
                                        <p class="text-danger">{{ $errors->first('password') }}</p>
                                        @endif

                                    </div>
                                </div>

                            </div>

                            <!-- Input dịch vụ sử dụng -->
                            <label for="Diachi">Dịch vụ sử dụng</label>
                            <select name="dichvu_Sd[]" multiple>
  <option style="background-color: orange;" class="select-all" >tất cả</option>
  @foreach ($dichvus as $dichvu)
  <option value="{{$dichvu->Name_Dv}}">{{$dichvu->Name_Dv}}</option>

  @endforeach
  ...
</select>
@if($errors->has('dichvu_Sd'))
<p class="text-danger">{{ $errors->first('dichvu_Sd') }}</p>
@endif

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />

<script>
$(document).ready(function() {
  $('select[name="dichvu_Sd[]"]').change(function() {
    if ($(this).find('option:selected').hasClass('select-all')) {
      $(this).find('option').prop('selected', true);
    }
  });
  $('select[name="dichvu_Sd[]"]').select2();
});

</script>

@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


                            <p style="font-size: 16px; font-weight: 500; color: #848387;"><span class="text-danger">*</span> Là trường thông tin bắt buộc</p>



                            <!-- Button thêm thiết bị -->
                            <p style="margin-top: 140px; margin-left: 357px;">
                                <a href="{{url('/')}}/Thietbi">
                                    <button type="button" class="button_huy">Hủy bỏ</button>
                                </a>
                                <a href="#">
                                    <button type="submit" class="button_xn">Thêm thiết bị</button>
                                </a>
                            </p>
                            @if(isset($success))
                            <script>
                                alert('{{$success}}');
                                window.location.href = "/Queuing_system/thietbi";
                            </script>
                            @endif
                        </form>
                    </div>
                </div>
            </div>

        </div>
        @endif
</form>

@endsection
