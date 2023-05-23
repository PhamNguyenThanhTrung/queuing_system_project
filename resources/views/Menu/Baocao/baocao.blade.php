@extends('Template.templates')

@section('header')
    <?php

    use Illuminate\Support\Facades\Auth;

    $user = session('user');
    $user = Auth::user();

    ?>
    @if ($user = session('user'))
        <form action="" style="width: 1220px; background-color: #f7f7f7; border: 1px solid #f7f7f7;">
            @csrf
            <div class="container mt-4">

                <div class="row">
                    <!-- Chia khung bên trái -->
                    <div class="col-lg-4">
                        <p style="width: 1200px; font-weight: 600; font-size: larger; margin-top: 5px; color: #848387;">Cấp
                            số
                            <span style="font-size: 10px; position: absolute; top: 38px;"><i
                                    class="fa-solid fa-chevron-right"></i></span>
                            <span style="color: orangered; padding-left: 10px;">Danh sách cấp số</span>
                        </p>
                    </div>
                </div>

                <div class="mt-3">
                    <h5 style="color: orangered; font-size: 28px;">Quản lý cấp số</h5>
                    <div class="row" style="width: 1200px;">
                        <!-- Danh sách thiết bị -->
                        <div class="col-lg-10">
                            <div class="row">


                                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                <script>
                                    $(document).ready(function() {
                                        $('.dropd_capso').change(function() {
                                            $(this).closest('form').submit();
                                        });
                                    });
                                </script>



                                <div class="col-lg-4">
                                    <p style="font-weight: 600; margin-bottom: 5px; margin-top: 11px;">Chọn thời gian</p>
                                    <p style="display: flex; align-items: center;">
                                        <input type="date" class="chonthoigian" name="thoigian_dau"
                                            value="{{ $thoigian_dau ?? '' }}" onchange="this.form.submit()">
                                        <span style="font-size: 16px; margin: 0px 10px;"><i
                                                class="fa-solid fa-caret-right"></i></span>
                                        <input type="date" class="chonthoigian" name="thoigian_cuoi"
                                            value="{{ $thoigian_cuoi ?? '' }}" onchange="this.form.submit()">
                                    </p>
                                </div>


                                <script>
                                    function submitFilterForm() {
                                        document.getElementById('filter-form').submit();
                                    }

                                    // Tự động submit form khi ngày được chọn
                                    document.addEventListener('DOMContentLoaded', function() {
                                        document.querySelectorAll('.chonthoigian').forEach(function(input) {
                                            input.addEventListener('change', submitFilterForm);
                                        });
                                    });
                                </script>

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
                                        <td class="th-border-left" style="color: #ffffff; font-size: 16px;">STT</td>
                                        <td class="border-table" style="color: #ffffff; font-size: 16px;">Tên khách hàng
                                        </td>
                                        <td class="border-table" style="color: #ffffff; font-size: 16px;">Tên dịch vụ</td>
                                        <td class="border-table" style="color: #ffffff; font-size: 16px;">Thời gian cấp</td>

                                        <td style="color: #ffffff; font-size: 16px;">Tình trạng</td>

                                        <td class="th-border-right" style="color: #ffffff; font-size: 16px;">Nguồn cấp</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($capsos as $capso)
                                        <!-- Dòng thứ nhất -->
                                        <tr class="color-tr-white">
                                            <td>{{ $capso->STT }}</td>
                                            <td class="border-table">{{ $capso->MemberName }}</td>
                                            <td>{{ $capso->Name_Dv }}</td>
                                            <td class="border-table">{{ $capso->created_at }}</td>

                                            <td class="border-table-left">
                                                @if ($capso->expired_at < now())
                                                    <svg width="8" height="9" viewBox="0 0 8 9" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <circle cx="4" cy="4.5" r="4"
                                                            fill="#FF0000" />
                                                    </svg> Bỏ qua
                                                @else
                                                    <svg width="8" height="9" viewBox="0 0 8 9" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <circle cx="4" cy="4.5" r="4"
                                                            fill="#4277ff" />
                                                    </svg> Đang chờ {{ date(' H:i') }}
                                                @endif

                                            </td>

                                            <td>{{ $capso->source }}</td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>

                        <!-- Button thêm thiết bị -->


                        <div class="themthietbi" style="height: 80px; padding-top: 15px;">
                            <a style="text-decoration: none; color: orangered;"href="{{ route('download.data') }}"
                                <div>
                                    <p><i class="fa-solid fa-file-arrow-down"></i><br>
                                    Tải về</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!--  -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($error->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

               <!-- Phân trang -->
        <div class="phantrang">

            <ul class="trang">
                <!-- Nút trang trước -->
                @if ($capsos->currentPage() > 1)
                    <li>
                        <a href="{{ $capsos->previousPageUrl() }}" style="font-size: 29px;"><i
                                class="fa-solid fa-caret-left"></i></a>
                    </li>
                @endif

                <!-- Các nút trang -->
                @php
                    $startPage = max($capsos->currentPage() - 1, 1);
                    $endPage = min($capsos->currentPage() + 1, $capsos->lastPage());
                @endphp

                @if ($startPage > 1)
                    <li><a href="{{ $capsos->url(1) }}">1</a></li>
                    @if ($startPage > 2)
                        <li><a href="#">...</a></li>
                    @endif
                @endif

                @for ($page = $startPage; $page <= $endPage; $page++)
                    @if ($page == $capsos->currentPage())
                        <li class="modautrang"><a href="{{ $capsos->url($page) }}">{{ $page }}</a></li>
                    @else
                        <li><a href="{{ $capsos->url($page) }}">{{ $page }}</a></li>
                    @endif
                @endfor

                @if ($endPage < $capsos->lastPage())
                    @if ($endPage < $capsos->lastPage() - 1)
                        <li><a href="#">...</a></li>
                    @endif
                    <li><a href="{{ $capsos->url($capsos->lastPage()) }}">{{ $capsos->lastPage() }}</a></li>
                @endif

                <!-- Nút trang sau -->
                @if ($capsos->hasMorePages())
                    <li>
                        <a href="{{ $capsos->nextPageUrl() }}" style="font-size: 29px;"><i
                                class="fa-solid fa-caret-right"></i></a>
                    </li>
                @endif
            </ul>




        </div>

            </div>
        </form>
    @endif
@endsection
