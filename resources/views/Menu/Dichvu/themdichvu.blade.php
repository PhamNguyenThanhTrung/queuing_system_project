@extends("Template.templates")

@section('header')
<?php

use Illuminate\Support\Facades\Auth;

$user = session('user');
$user = Auth::user();

?>
<!-- Hiện thông tin user -->

<div action="" style="width: 1220px; background-color: #f7f7f7; border: 1px solid #f7f7f7;">
  @csrf
  @if($user = session('user'))
  <div class="container mt-4">

    <div class="row">
      <!-- Chia khung bên trái -->
      <div class="col-lg-4">
        <p style="width: 1200px; font-weight: 800; font-size: larger; margin-top: 5px; color: #848387;">Dịch vụ
          <span style="font-size: 10px; position: absolute; top: 38px;"><i class="fa-solid fa-chevron-right"></i></span>
          <span style="padding-left: 10px;"><a href="{{url('/')}}/Dichvu" style="color: #848387; text-decoration: none;">Danh sách dịch vụ</a></span>
          <span style="font-size: 10px; position: absolute; top: 38px;"><i class="fa-solid fa-chevron-right"></i></span>
          <span style="color: orangered; padding-left: 10px;">Thêm dịch vụ</span>
        </p>
      </div>
    </div>

    <div class="mt-2">
      <h5 style="color: orangered; font-size: 28px;">Quản lý dịch vụ</h5>
      <div class="khung_dichvu">
        <div class="container">
          <p style="padding-top: 20px; font-size: 25px; font-weight: 500; color: orangered;">Thông tin dịch vụ</p>
          <div class="row" >
            <form method="POST"  action="{{ route('dichvu.ThemDV') }}">
              @csrf
              <div class="row">
              <div class="col-lg-6">
                <div class="col-lg-12">
                  <!-- Input mã dịch vụ -->
                  <label for="code_Dv">ID Dịch Vụ</label>
                  <input type="text" class="form-control" name="code_Dv" required>
                  @if($errors->has('code_Dv'))
                  <p class="text-danger">{{ $errors->first('code_Dv') }}</p>
                  @endif
                </div>
                <div class="col-lg-12">
                  <!-- Input tên dịch vụ -->
                  <label for="Name_Dv">Tên dịch vụ</label>
                  <input type="text" class="form-control" name="Name_Dv" required>
                  @if($errors->has('Name_Dv'))
                  <p class="text-danger">{{ $errors->first('Name_Dv') }}</p>
                  @endif
                </div>

                <h9 style="color: orangered; font-size: 28px;">Quy tắc cấp số</h9>

                <!-- Quy tắc cấp số -->
                <div class="row mt-3">
                  <!-- Tăng tự động từ -->
                  <p class="phanquyen">



    <div class="col-lg-7" style="width: 190px;">
        <span class="form-check">
            <input class="form-check-input" type="checkbox" id="tcchucnanga" name="Rules_of_grant[]"  value="ttd:0001-9999"
                style="margin-top: 7px;">
            <label class="form-check-label" style="font-size: 18px; font-weight: 400;">Tăng tự động từ</label>

        </span>
    </div>
    <div class="col-lg-5">
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


    <div class="col-lg-6" style="width: 170px; margin-top: 20px;">   <span class="form-check">
                        <input class="form-check-input" type="checkbox" id="chucnangxa" name="Rules_of_grant[]" value="Prefix:0001"
                            style="margin-top: 7px;">
                        <label class="form-check-label" style="font-size: 18px; font-weight: 400;">Prefix</label>
                    </span>

    </div>
    <div class="col-lg-6" style="margin-top: 20px;">
        <label>
            <span class="tangtudong">
            <input value=" 0001" class="col-md-4" disabled>
            </span>
        </label>
    </div>



    <div class="col-lg-6" style="width: 170px; margin-top: 20px;">
        <span class="form-check">
            <input class="form-check-input" type="checkbox" id="chucnangya" name="Rules_of_grant[]" value="surfix:0001"
                style="margin-top: 7px;">
            <label class="form-check-label" style="font-size: 18px; font-weight: 400;">surfix</label>
        </span>

    </div>
    <div class="col-lg-6" style="margin-top: 20px;">
        <label>
            <span class="tangtudong">
            <input value=" 0001" class="col-md-4" disabled>
            </span>
        </label>
    </div>

<div>

    <span class="form-check">
        <input class="form-check-input" type="checkbox" id="chucnangza" name="Rules_of_grant[]" value="resetday"
            style="margin-top: 7px;">
        <label class="form-check-label" style="font-size: 18px; font-weight: 400;">Reset mổi ngày</label>
    </span>
</div>


                </p>
                  @if($errors->has('Rules_of_grant'))
                  <p class="text-danger">{{ $errors->first('Rules_of_grant') }}</p>
                  @endif
                </div>    </div>


              <div class="col-lg-6">
                <!-- Input mô tả -->


                  <label for="Describe_Dv">Mô tả</label>
                  <textarea  class="form-control" placeholder="Mô tả dịch vụ" style="height:100px;padding-bottom: 70px;
                  box-sizing: border-box;" type="text" name="Describe_Dv" required></textarea>
                </div>


              @if($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
          </div>
          </div>
          <p style="font-size: 16px; font-weight: 500; color: #848387;"><span class="text-danger">*</span> Là trường thông tin bắt buộc</p>
          <p style="margin-top: 70px; margin-left: 357px;">
            <a href="{{url('/')}}/Dichvu">
              <button type="button" class="button_huy">Hủy bỏ</button>
            </a>
            <a href="#">
              <button type="submit" class="button_xn">Thêm dịch vụ</button>
            </a>
          </p>
          </form>


          <!-- Button thêm thiết bị -->

        <!-- Trong view -->


        </div>
      </div>
    </div>

  </div>
  @endif
</div>

@endsection
