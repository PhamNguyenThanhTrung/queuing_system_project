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
        <p style="width: 1200px; font-weight: 600; font-size: larger; margin-top: 5px; color: #848387;">Dịch vụ
          <span style="font-size: 10px; position: absolute; top: 38px;"><i class="fa-solid fa-chevron-right"></i></span>
          <span style="padding-left: 10px;"><a href="{{url('/')}}/Dichvu" style="color: #848387; text-decoration: none;">Danh sách dịch vụ</a></span>
          <span style="font-size: 10px; position: absolute; top: 38px;"><i class="fa-solid fa-chevron-right"></i></span>
          <span style="color: orangered; padding-left: 10px;">Cập nhật dịch vụ</span>
        </p>
      </div>
    </div>

    <div class="mt-2">
      <h5 style="color: orangered; font-size: 28px;">Quản lý dịch vụ</h5>
      <div class="khung_dichvu">
        <div class="container">
          <p style="padding-top: 20px; font-size: 25px; font-weight: 500; color: orangered;">Thông tin dịch vụ</p>
          <div class="row">
          <form method="POST" action="{{ route('dichvu.updateDV',$dichvu->ID_Dv) }}">
              @csrf
    @method('PUT')
              <div class="col-lg-6">
                <div class="col-lg-12">
                  <!-- Input mã dịch vụ -->
                  <label for="code_Dv">ID Dịch Vụ</label>
                  <input type="text" class="form-control" value="{{$dichvu->code_Dv}}"  name="code_Dv" >
                  @if($errors->has('code_Dv'))
                    <span class="text-danger">{{ $errors->first('code_Dv') }}</span>

                  @endif
                </div>
                <div class="col-lg-12">
                  <!-- Input tên dịch vụ -->
                  <label for="Name_Dv">Name_Dv</label>
                  <input type="text" class="form-control"  value="{{$dichvu->Name_Dv}}" name="Name_Dv" >
                  @if($errors->has('Name_Dv'))
                  <p class="text-danger">{{ $errors->first('Name_Dv') }}</p>
                  @endif
                </div>

                <h5 style="color: orangered; font-size: 28px;">Quy tắc cấp số</h5>

                <!-- Quy tắc cấp số -->
                <div class="row mt-3">
                  <!-- Tăng tự động từ -->
                  <p class="phanquyen">
                    <span style="padding-top: 20px; font-size: 25px; font-weight: 500; color: orangered;">Nhóm chức năng A</span>

                    <p class="phanquyen">



                        <div class="col-lg-7" style="width: 190px;">

                                <span class="form-check">
                                    <input class="form-check-input" type="checkbox" id="tcchucnanga" name="Rules_of_grant[]"  value="ttd:0001-9999"
                                        style="margin-top: 7px;"  {{ str_contains($dichvu->Rules_of_grant, 'ttd:0001-9999') ? 'checked' : '' }}  >
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


                        <div class="col-lg-6" style="width: 170px; margin-top: 20px;">      <span class="form-check">
                            <input class="form-check-input" type="checkbox" id="chucnangxa" name="Rules_of_grant[]" value="Prefix:0001"
                                style="margin-top: 7px;"{{ str_contains($dichvu->Rules_of_grant, 'Prefix:0001') ? 'checked' : '' }}  >
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
                                    style="margin-top: 7px;" {{ str_contains($dichvu->Rules_of_grant, 'surfix:0001') ? 'checked' : '' }}  >
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



                        <div class="col-lg-6" style="width: 170px; margin-top: 20px;">
                            <span class="form-check">

                                    <input class="form-check-input" type="checkbox" id="chucnangza" name="Rules_of_grant[]" value="resetday"
                                        style="margin-top: 7px;" {{ str_contains($dichvu->Rules_of_grant, 'resetday') ? 'checked' : '' }}  >
                                    <label class="form-check-label" style="font-size: 18px; font-weight: 400;">Reset mổi ngày</label>

                            </span>

                        </div>








                    </div>


                                    </p>


                </p>
                @if($errors->has('Rules_of_grant'))
                <p class="text-danger">{{ $errors->first('Rules_of_grant') }}</p>
                @endif


                  {{-- <div class="form-group" style="display:flex">
                    <div class="col-lg-4 mt-1">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="TTD-checkbox" name="Rules_of_grant[]" value="prefix1">
                        <label class="form-check-label" for="TTD-checkbox">Tăng tự dộng từ :</label>
                      </div>
                    </div>
                    <div class="col-lg-4 mt-1">
                      <label for="TTD-input"> <input type="text" class="col-md-3" id="increment-input" value="0001" name="value_increment" placeholder="Enter prefix1 value" disabled>
                        đến <input type="text" class="col-md-3" id="increment-input" value="9999" name="value_increment" placeholder="Enter increment value" disabled>
                      </label>
                      <input type="text" class="form-control" id="TTD-input" value="ttd:0001-9999" name="value_TTD" placeholder="Enter prefix value" hidden disabled>
                    </div>
                  </div>
                  <br><br>



                  <div class="form-group" style="display:flex">
                    <div class="col-lg-4 mt-1">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="prefix-checkbox" name="Rules_of_grant1[]" value="prefix">
                        <label class="form-check-label" for="prefix-checkbox">Prefix</label>
                      </div>
                    </div>
                    <div class="col-lg-4 mt-1">
                      <label for="prefix-input"> <input type="text" class="col-md-3" id="increment-input" value="0001" name="value_increment" placeholder="Enter prefix value" disabled></label>
                      <input type="text" class="form-control" id="prefix-input" value="Prefix:0001" name="value_Prefix" placeholder="Enter prefix value" hidden disabled>
                    </div>
                  </div>
                  <br><br>
                  <div class="form-group" style="display:flex">
                    <br>
                    <div class="col-lg-4 mt-1">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="surfix-checkbox" name="Rules_of_grant2[]" value="surfix">
                        <label class="form-check-label" for="prefix-checkbox">Surfix</label>
                      </div>
                    </div>
                    <div class="col-lg-4 mt-1">
                      <label for="prefix-input"> <input type="text" class="col-md-4" id="increment-input" value="0001" name="value_increment" placeholder="Enter increment value" disabled></label>
                      <input type="text" class="form-control" id="surfix-input" value="surfix:0001" name="value_Surfix" placeholder="Enter prefix value" hidden disabled>
                    </div>
                  </div>


                  <div class="form-group">
                    <div class="col-lg-6 mt-3">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="reset-daily-checkbox" name="Rules_of_grant3[]" value="prefix">
                        <label class="form-check-label" for="reset-daily-checkbox">Reset mỗi ngày</label>
                      </div>
                    </div>
                    <div class="col-lg-6 mt-3">
                      <label for="reset-daily-input"> </label>
                      <input type="text" class="form-control" id="reset-daily-input" value="resetEveryday" name="reset-daily-value" placeholder="Enter prefix value" hidden disabled>
                    </div>
                  </div> --}}



                </div>



              </div>

              <div class="col-lg-6">
                <!-- Input mô tả -->
                <div class="col-lg-12">
                  <label for="Describe_Dv">Mô tả</label>
                  <input type="text"  value="{{$dichvu->Describe_Dv}}" name="Describe_Dv" required>
                </div>
              </div>

          </div>

          <p style="font-size: 16px; font-weight: 500; color: #848387;"><span class="text-danger">*</span> Là trường thông tin bắt buộc</p>
          <p style="margin-top: 70px; margin-left: 357px;">
            <a href="{{url('/')}}/Dichvu">
              <button type="button" class="button_huy">Hủy bỏ</button>
            </a>
            <a href=" {{ route('dichvu.showchitietDV',['ID_Dv' => $dichvu->ID_Dv]) }}">
              <button type="submit" class="button_xn">Cập nhật dịch vụ</button>
            </a>
          </p>
          </form>


          <!-- Button thêm thiết bị -->

          <!-- @if(isset($success))
                                    <script>
                                        alert('{{$success}}');
                                        window.location.href = "/Queuing_system/thietbi";
                                    </script>
                                @endif -->
        </div>
      </div>
    </div>

  </div>
  @endif
</div>

@endsection
