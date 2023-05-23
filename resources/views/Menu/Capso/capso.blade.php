@extends('Template.templates')

@section('header')
    <?php

    use Illuminate\Support\Facades\Auth;
    use Carbon\Carbon;
    $user = session('user');
    $user = Auth::user();
    $currentTime = Carbon::now();
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
                                <div class="col-lg-2">
                                    <p style="font-weight: 600; line-height: 35px; margin-top: 5px;">Tên dịch vụ <br>
                                        <span class="dropdown-icon_capso">

                                            <select name="tendv" class="dropd_capso">
                                                <option value="" disabled hidden selected>Tất cả</option>
                                                <option value="Tất cả">Tất cả</option>
                                                @foreach ($dichvus as $dichvu)
                                                <option value="{{$dichvu->Name_Dv}}">{{$dichvu->Name_Dv}}</option>

                                                @endforeach

                                            </select>
                                            <span class="icon_dropd"><i class="fa-solid fa-caret-down"></i></span>

        </form>
        </span>
        </p>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.dropd_capso').change(function() {
                    $(this).closest('form').submit();
                });
            });
        </script>

        <div class="col-lg-2">
            <p style="font-weight: 600; line-height: 35px; margin-top: 5px;">Tình trạng <br>
                <span class="dropdown-icon_capso">
                    <select name="Tinhtrang" class="dropd_capso">
                        <option value="" disabled hidden selected>Tất cả</option>
                        <option value="Đang chờ">Đang chờ</option>
                        <option value="Đã sử dụng">Đã sử dụng</option>
                        <option value="Bỏ qua">Bỏ qua</option>
                    </select>
                    <span class="icon_dropd"><i class="fa-solid fa-caret-down"></i></span>
                </span>
            </p>
        </div>


        <div class="col-lg-2">
            <p style="font-weight: 600; line-height: 35px; margin-top: 5px;">Nguồn cấp <br>
                <span class="dropdown-icon_capso">
                    <select name="source" class="dropd_capso">
                        <option value="" disabled hidden selected>Tất cả</option>
                        <option value="Kiosk">Kiosk</option>
                        <option value="Display counter">Hệ thống</option>
                    </select>
                    <span class="icon_dropd"><i class="fa-solid fa-caret-down"></i></span>
                </span>
            </p>
        </div>
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


        <div class="col-lg-4" style="width:150px;">
                <p style="font-weight: 600; line-height: 40px;">Từ khóa
                    <span class="dropdown-icon">
                        <input type="search" class="dropd" name="timkiem" placeholder="Nhập từ khóa">
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
                            <td class="th-border-left" style="color: #ffffff; font-size: 16px;">STT</td>
                            <td class="border-table" style="color: #ffffff; font-size: 16px;">Tên khách hàng</td>
                            <td class="border-table" style="color: #ffffff; font-size: 16px;">Tên dịch vụ</td>
                            <td class="border-table" style="color: #ffffff; font-size: 16px;">Thời gian cấp</td>
                            <td class="border-table" style="color: #ffffff; font-size: 16px;">Hạn sử dụng</td>
                            <td style="color: #ffffff; font-size: 16px;">Trạng thái</td>
                            <td class="border-table-right" style="color: #ffffff; font-size: 16px;">Nguồn cấp</td>
                            <td class="th-border-right" style="color: #ffffff; font-size: 16px;"></td>
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
                                <td>{{ $capso->expired_at }}</td>
                                <td class="border-table-left">
                                    @if ($currentTime > $capso->expired_at)
                                        <svg width="8" height="9" viewBox="0 0 8 9" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="4" cy="4.5" r="4" fill="#FF0000" />
                                        </svg>{{ $capso->Tinhtrang = 'Bỏ qua' }}
                                        <?php
                                        $currentTime = now();
                                        if ($currentTime > $capso->expired_at) {
                                            $capso->Tinhtrang = 'Bỏ qua';
                                        } elseif ($currentTime < $capso->created_at->addMinutes(15)) {
                                            $capso->Tinhtrang = 'Đã sử dụng';
                                        } else {
                                            $capso->Tinhtrang = 'Đang chờ';
                                        }

                                        $capso->save();

                                        $capso->save();
                                        ?>
                                    @elseif($currentTime < $capso->created_at->addMinutes(15))
                                        <svg width="8" height="9" viewBox="0 0 8 9" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="4" cy="4.5" r="4" fill="#4277ff" />
                                        </svg> {{ $capso->Tinhtrang = 'Đã sử dụng' }}
                                        <?php
                                        $currentTime = now();
                                        if ($currentTime > $capso->expired_at) {
                                            $capso->Tinhtrang = 'Bỏ qua';
                                        } elseif ($currentTime < $capso->created_at->addMinutes(15)) {
                                            $capso->Tinhtrang = 'Đã sử dụng';
                                        } else {
                                            $capso->Tinhtrang = 'Đang chờ';
                                        }

                                        $capso->save();

                                        ?>
                                    @else
                                        <svg width="8" height="9" viewBox="0 0 8 9" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="4" cy="4.5" r="4" fill="#4277ff" />
                                        </svg> {{ $capso->Tinhtrang = 'Đang chờ' }}
                                        <?php
                                        $currentTime = now();
                                        if ($currentTime > $capso->expired_at) {
                                            $capso->Tinhtrang = 'Bỏ qua';
                                        } elseif ($currentTime < $capso->created_at->addMinutes(15)) {
                                            $capso->Tinhtrang = 'Đã sử dụng';
                                        } else {
                                            $capso->Tinhtrang = 'Đang chờ';
                                        }

                                        $capso->save();

                                        ?>
                                    @endif

                                </td>

                                <td>{{ $capso->source }}</td>
                                <td class="border-table-left"><a
                                        href="{{ route('capso.showchitietCS', ['STT' => $capso->STT]) }}">Xem thêm </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            @if(session('success'))
            <script>
                alert('{{ session('success') }}');

            </script>
            @endif
            <!-- Button thêm thiết bị -->
            <div class="themthietbi">
                <a href="{{ url('/Capsomoi') }}?tangtudong=something" style="text-decoration: none; color: orangered;">
                    <div>
                        <p><i class="fa-solid fa-square-plus"></i><br>
                            Cấp <br> số mới</p>
                    </div>
                </a>
            </div>
        </div>
        <!--  -->
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
        </form>
    @endif
@endsection
