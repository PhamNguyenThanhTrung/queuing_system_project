@extends('Template.templates')

@section('header')
    <?php

    use Illuminate\Support\Facades\Auth;

    $user = session('user');
    $user = Auth::user();

    ?>
    <!-- Hiện thông tin user -->

    <form action="" style="width: 1220px; background-color: #f7f7f7; border: 1px solid #f7f7f7;">
        @csrf
        <div class="container mt-4">

            <div class="row">
                <!-- Chia khung bên trái -->
                <div class="col-lg-4">
                    <p style="width: 1200px; font-weight: 600; font-size: larger; margin-top: 5px; color: #848387;">Thiết bị
                        <span style="font-size: 10px; position: absolute; top: 38px;"><i
                                class="fa-solid fa-chevron-right"></i></span>
                        <span style="color: orangered; padding-left: 10px;">Danh sách dịch vụ</span>
                    </p>
                </div>
            </div>

            <div class="mt-3">
                <h5 style="color: orangered; font-size: 28px;">Quản lý dịch vụ</h5>
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
                            {{--  --}}


                                <div class="col-lg-4">
                                    <p style="font-weight: 600; margin-bottom: 5px; margin-top: 11px;">Chọn thời gian</p>
                                    <p style="display: flex; align-items: center;">
                                        <input type="date" class="chonthoigian" name="thoigian_dau" value="{{ $thoigian_dau ?? '' }}"  onchange="this.form.submit()">
                                        <span style="font-size: 16px; margin: 0px 10px;"><i class="fa-solid fa-caret-right"></i></span>
                                        <input type="date" class="chonthoigian" name="thoigian_cuoi" value="{{ $thoigian_cuoi ?? '' }}" onchange="this.form.submit()">
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



                                <div class="col-lg-4">
                                    <p style="font-weight: 600; line-height: 40px;">Từ khóa
                                        <span class="dropdown-icon">
                                            <input type="search" class="dropd" name="timkiem" placeholder="Nhập từ khóa" value="{{ $timkiem ?? '' }}" oninput="submitFilterForm()">
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
                                    <td class="th-border-left" style="color: #ffffff; font-size: 16px;">Mã dịch vụ</td>
                                    <td class="border-table" style="color: #ffffff; font-size: 16px;">Tên dịch vụ</td>
                                    <td class="text-light" style="color: #ffffff; font-size: 16px;">Mô tả</td>
                                    <td class="border-table" style="color: #ffffff; font-size: 16px;">Trạng thái hoạt động
                                    </td>
                                    <td class="border-table" style="color: #ffffff; font-size: 16px;"></td>
                                    <td class="th-border-right" style="color: #ffffff; font-size: 16px;"></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dichvus as $dichvu)
                                    <!-- Dòng thứ nhất -->
                                    <tr class="color-tr-white">
                                        <td>{{ $dichvu->code_Dv }}</td>
                                        <td class="border-table">{{ $dichvu->Name_Dv }}</td>
                                        <td>{{ $dichvu->Describe_Dv }}</td>

                                        <td class="border-table">
                                            @if ($dichvu->Tinhtrang == 'Hoạt động')
                                                <svg width="8" height="9" viewBox="0 0 8 9" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="4" cy="4.5" r="4" fill="#34C759" />
                                                </svg>
                                            @else
                                                <svg width="8" height="9" viewBox="0 0 8 9" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="4" cy="4.5" r="4" fill="red" />
                                                </svg>
                                            @endif
                                            {{ $dichvu->Tinhtrang }}
                                        </td>

                                        <td> <a href=" {{ route('dichvu.showchitietDV', ['ID_Dv' => $dichvu->ID_Dv]) }}">Xem
                                                thêm </a></td>


                                            <td><a href="{{ route('dichvu.editDV', ['ID_Dv' => $dichvu->ID_Dv, 'tangtudong1' => 'something',]) }}">Cập nhật</a></td>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>

                    <!-- Button thêm thiết bị -->
                    @if ($user = session('user'))
                        <div class="themthietbi">
                            <a href="{{ url('/ThemDV') }}?tangtudong=something" style="text-decoration: none; color: orangered;">
                                <div>
                                    <p><i class="fa-solid fa-square-plus"></i><br>
                                        Thêm Dịch vụ</p>
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
                @if ($dichvus->currentPage() > 1)
                    <li>
                        <a href="{{ $dichvus->previousPageUrl() }}" style="font-size: 29px;"><i
                                class="fa-solid fa-caret-left"></i></a>
                    </li>
                @endif

                <!-- Các nút trang -->
                @php
                    $startPage = max($dichvus->currentPage() - 1, 1);
                    $endPage = min($dichvus->currentPage() + 1, $dichvus->lastPage());
                @endphp

                @if ($startPage > 1)
                    <li><a href="{{ $dichvus->url(1) }}">1</a></li>
                    @if ($startPage > 2)
                        <li><a href="#">...</a></li>
                    @endif
                @endif

                @for ($page = $startPage; $page <= $endPage; $page++)
                    @if ($page == $dichvus->currentPage())
                        <li class="modautrang"><a href="{{ $dichvus->url($page) }}">{{ $page }}</a></li>
                    @else
                        <li><a href="{{ $dichvus->url($page) }}">{{ $page }}</a></li>
                    @endif
                @endfor

                @if ($endPage < $dichvus->lastPage())
                    @if ($endPage < $dichvus->lastPage() - 1)
                        <li><a href="#">...</a></li>
                    @endif
                    <li><a href="{{ $dichvus->url($dichvus->lastPage()) }}">{{ $dichvus->lastPage() }}</a></li>
                @endif

                <!-- Nút trang sau -->
                @if ($dichvus->hasMorePages())
                    <li>
                        <a href="{{ $dichvus->nextPageUrl() }}" style="font-size: 29px;"><i
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


        </div>
    </form>

@endsection
