@extends('Template.templates')

@section('header')
    <?php

    use Illuminate\Support\Facades\Auth;

    $user = session('user');
    $user = Auth::user();

    ?>
    <!-- Hiện thông tin user -->

    <div style="width: 1220px; background-color: #f7f7f7; border: 1px solid #f7f7f7;">
        @csrf
        @if ($user = session('user'))
            <div class="container mt-4">

                <div class="row">
                    <!-- Chia khung bên trái -->
                    <div class="col-lg-4">
                        <p style="width: 1200px; font-weight: 600; font-size: larger; margin-top: 5px; color: #848387;">Cài
                            đặt hệ thống
                            <span style="font-size: 10px; position: absolute; top: 38px;"><i
                                    class="fa-solid fa-chevron-right"></i></span>
                            <span style="padding-left: 10px;"><a href="{{ url('/') }}/Vaitro"
                                    style="color: #848387; text-decoration: none;">Quản lý vai trò</a></span>
                            <span style="font-size: 10px; position: absolute; top: 38px;"><i
                                    class="fa-solid fa-chevron-right"></i></span>
                            <span style="color: orangered; padding-left: 10px;">Thêm vai trò</span>
                        </p>
                    </div>
                </div>

                <div class="mt-2">
                    <h5 style="color: orangered; font-size: 28px;">Danh sách vai trò</h5>
                    <div class="khung_dichvu">
                        <div class="container">
                            <p style="padding-top: 20px; font-size: 25px; font-weight: 500; color: orangered;">Thông tin vai
                                trò</p>
                            <div class="row">
                                <form method="POST" action="{{ route('vaitro.updateVT',$vaitro->ID_VT) }}">
                                    @csrf
@method('PUT')
                                    <div style="display:flex;">
                                        <div class="col-lg-6">
                                            <div class="col-lg-12">
                                                <!-- Input mã dịch vụ -->
                                              
                                                    <p>Tên vai trò: <span class="text-danger">*</span>
                                                        <span class="dropdown-loai">
                                                            <input name="Name_VT" value="{{$vaitro->Name_VT}}" class="select_loai">




                                                        </span>
                                                    </p>
                                                </p>
                                            </div>

                                            <div class="col-lg-12">
                                                <!-- Input mô tả -->
                                                <p>

                                                    <label for="source">Mô tả:</label>
                                                    <input type="text" class="bg-outline-secondary" style="width:450px;border-radius:10px;height:120px;color: #848387" value="{{$vaitro->source}}" class="nhap_themdichvu" name="source"
                                                        placeholder="Nhập mô tả" >
                                                </p>
                                                @if ($errors->has('source'))
                                                    <p class="text-danger">{{ $errors->first('source') }}</p>
                                                @endif
                                            </div>

                                            <p style="font-size: 16px; font-weight: 500; color: #848387;"><span
                                                    class="text-danger">*</span> Là trường thông tin bắt buộc</p>
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="col-lg-12">
                                                <!-- Phân quyền chức năng -->
                                                <p style="line-height: 0px; margin-top: 5px;">Phân quyền chức năng: <span
                                                        class="text-danger">*</span>
                                                        <p class="phanquyen">
                                                            <span style="padding-top: 20px; font-size: 25px; font-weight: 500; color: orangered;">Nhóm chức năng A</span>
                                                            <span class="form-check">
                                                                <input class="form-check-input" type="checkbox" id="tcchucnanga" name="Nhom_A[]" value="TatCa"
                                                                    style="margin-top: 7px;" {{ str_contains($vaitro->Nhom_A, 'TatCa') ? 'checked' : '' }}>
                                                                <label class="form-check-label" style="font-size: 18px; font-weight: 400;">Tất cả</label>
                                                            </span>
                                                            <span class="form-check">
                                                                <input class="form-check-input" type="checkbox" id="chucnangxa" name="Nhom_A[]" value="ChiXem"
                                                                    style="margin-top: 7px;" {{ str_contains($vaitro->Nhom_A, 'ChiXem') ? 'checked' : '' }}                                                                    >
                                                                <label class="form-check-label" style="font-size: 18px; font-weight: 400;">chỉ xem</label>
                                                            </span>
                                                            <span class="form-check" >
                                                                <input class="form-check-input" type="checkbox" id="chucnangya" name="Nhom_A[]" value="ThemDuLieu"
                                                                    style="margin-top: 7px;"{{ str_contains($vaitro->Nhom_A, 'ThemDuLieu') ? 'checked' : '' }}>
                                                                <label class="form-check-label" style="font-size: 18px; font-weight: 400;">Thêm dữ liệu</label>
                                                            </span>
                                                            <span class="form-check">
                                                                <input class="form-check-input" type="checkbox" id="chucnangza" name="Nhom_A[]" value="ChinhSuaDuLieu"
                                                                    style="margin-top: 7px;"{{ str_contains($vaitro->Nhom_A, 'ChinhSuaDuLieu') ? 'checked' : '' }}>
                                                                <label class="form-check-label" style="font-size: 18px; font-weight: 400;">Chỉnh sửa dữ liệu</label>
                                                            </span>
                                                            <span class="form-check">
                                                                <input class="form-check-input" type="checkbox" id="chucnangzza" name="Nhom_A[]" value="QuanLyTaiKhoan"
                                                                    style="margin-top: 7px;" {{ str_contains($vaitro->Nhom_A, 'QuanLyTaiKhoan') ? 'checked' : '' }}>
                                                                <label class="form-check-label" style="font-size: 18px; font-weight: 400;">Quản lý tài khoản</label>
                                                            </span>
                                                        </p>
                                                </p>
                                            </div>
                                        </div>




                                    </div>    <p style="margin-top: 40px; margin-left: 357px;">
                                            <a href="{{ url('') }}/Vaitro">
                                                <button type="button" class="button_huy">Hủy bỏ</button>
                                            </a>
                                            <a href="#">
                                                <button type="submit" class="button_xn">Cập nhật</button>
                                            </a>
                                        </p>
                                </form>
                            </div>

                            <!-- Button thêm vai trò -->

                            <!-- @if (isset($success))
    <script>
        alert('{{ $success }}');
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
