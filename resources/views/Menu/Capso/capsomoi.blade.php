@extends('Template.templates')

@section('header')
    <?php

    use Illuminate\Support\Facades\Auth;

    $user = session('user');
    $user = Auth::user();

    ?>
    <!-- Hiện thông tin user -->

    <div action="" style="width: 1220px; background-color: #f7f7f7; border: 1px solid #f7f7f7;">
        @csrf
        @if ($user = session('user'))
            <div class="container mt-4">

                <div class="row">
                    <!-- Chia khung bên trái -->
                    <div class="col-lg-4">
                        <p style="width: 1200px; font-weight: 600; font-size: larger; margin-top: 5px; color: #848387;">Cấp
                            số
                            <span style="font-size: 10px; position: absolute; top: 38px;"><i
                                    class="fa-solid fa-chevron-right"></i></span>
                            <span style="padding-left: 10px;"><a href="{{ url('/') }}/capso"
                                    style="color: #848387; text-decoration: none;">Danh sách cấp số</a></span>
                            <span style="font-size: 10px; position: absolute; top: 38px;"><i
                                    class="fa-solid fa-chevron-right"></i></span>
                            <span style="color: orangered; padding-left: 10px;">Cấp số mới</span>
                        </p>
                    </div>
                </div>

                <div class="mt-2">
                    <h5 style="color: orangered; font-size: 28px;">Quản lý cấp số</h5>
                    <div class="khung_themthietbi">
                        <div class="container" style="text-align: center;">
                            <form id="myForm" method="POST" action="{{ route('capso.Capsomoi') }}">
                                @csrf
                                <p style="padding-top: 20px; font-size: 35px; font-weight: 500; color: orangered;">Cấp số
                                    mới</p>
                                <div>
                                    <p style="font-size: 18px; font-weight: 500;">Dịch vụ khách hàng lựa chọn</p>
                                    <label for="Name_Dv">Cấp số :</label><br>
                                    <span class="dropdown-loai">
                                        <select name="Name_Dv" class="select_loai">
                                            <option value="" disabled hidden selected>Chọn loại thiết bị</option>
                                            @foreach ($dichvus as $dichvu)
                                            <option value="{{$dichvu->Name_Dv}}">{{$dichvu->Name_Dv}}</option>

                                            @endforeach
                                        </select>
                                        <span class="icon_dropd"><i class="fa-solid fa-caret-down"></i></span>
                                    </span>
                                </div>

                                @if($errors->any())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        {{ $error }}<br>
                                    @endforeach
                                </div>
                            @endif



                                <!-- Button thêm thiết bị -->
                                <p style="margin-top: 50px; text-align: center;">
                                    <a href="{{ url('/') }}/Capso">
                                        <button type="button" class="button_huy" style="background-color: white;">Hủy
                                            bỏ</button>
                                    </a>
                                    <a href="#">
                                        <button type="submit" class="button_xn"
                                          >In số</button>
                                    </a>
                                </p>
                            </form>

                            <!-- ==== Popup ==== -->
                            <div class="modal fade" id="staticBackdrop" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        @if(session('Capsomoi'))
                                        <button type="button" class="btn-close-popup" data-bs-dismiss="modal" aria-label="Close">
                                            <i class="fa-solid fa-x"></i>
                                        </button>
                                        <div class="content-header">
                                            <h3>Số thứ tự được cấp</h3>
                                            <h2 id="sttValue">{{session('Capsomoi')->STT}}</h2>
                                            <p>DV:{{session('Capsomoi')->Name_Dv}}<span id="nameDvValue"></span> <b>(tại quầy số 1)</b></p>
                                        </div>
                                        <div class="content-footer">
                                            <div>
                                                <div class="text-datetime">
                                                    <p>Thời gian cấp<span id="thoigiancap">{{session('Capsomoi')->created_at}}</span></p>



                                                </div>
                                                <div class="text-datetime">
                                                    <p>Hạn sử dụng<span id="thoigianhan">{{session('Capsomoi')->expired_at}}</span></p>

                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



                                    @if (session('Capsomoi'))

                                        <!-- Show the modal if there are no errors -->

                                        <script>

                                            $(document).ready(function () {

                                                $('#staticBackdrop').modal('show');

                                            });

                                        </script>

                                    @endif

        @endif
    </div>
@endsection
